const STORAGE_KEY = "bugtracker.items.v1";
const priorityLabels = { high: "Haute", medium: "Moyenne", low: "Basse" };
const initialBugs = [
  {
    id: 1,
    title: "Erreur formulaire",
    description: "Le formulaire ne se valide pas.",
    priority: "high",
    status: "open",
    createdAt: "2026-08-25",
  },
];

const form = document.querySelector("#bug-form");
const titleInput = document.querySelector("#bug-title");
const descriptionInput = document.querySelector("#bug-description");
const priorityInput = document.querySelector("#bug-priority");
const priorityFilter = document.querySelector("#filter-priority");
const searchInput = document.querySelector("#search-title");
const bugList = document.querySelector("#bug-list");
const emptyState = document.querySelector("#empty-state");
const formFeedback = document.querySelector("#form-feedback");

function loadBugs() {
  try {
    const storedBugs = JSON.parse(localStorage.getItem(STORAGE_KEY));
    return Array.isArray(storedBugs) ? storedBugs : initialBugs;
  } catch {
    return initialBugs;
  }
}

let bugs = loadBugs();

function saveBugs() {
  localStorage.setItem(STORAGE_KEY, JSON.stringify(bugs));
}

function formatDate(date) {
  return new Intl.DateTimeFormat("fr-FR", { day: "2-digit", month: "short", year: "numeric" }).format(new Date(`${date}T00:00:00`));
}

function makeElement(tagName, className, text) {
  const element = document.createElement(tagName);
  if (className) element.className = className;
  if (text !== undefined) element.textContent = text;
  return element;
}

function renderBug(bug) {
  const row = makeElement("article", "bug-row");
  const main = makeElement("div", "bug-main");
  const titleLine = makeElement("div", "bug-title-line");
  const title = makeElement("h3", "bug-title", bug.title);
  const priority = makeElement("span", `priority-badge priority-${bug.priority}`, priorityLabels[bug.priority]);
  const description = makeElement("p", "bug-description", bug.description);
  const meta = makeElement("div", "bug-meta");
  const date = makeElement("time", "", formatDate(bug.createdAt));
  date.dateTime = bug.createdAt;
  const divider = makeElement("span", "meta-divider", "/");
  const status = makeElement("span", `status-label${bug.status === "closed" ? " closed" : ""}`, bug.status === "closed" ? "Fermé" : "Ouvert");
  const actions = makeElement("div", "bug-actions");
  const toggleButton = makeElement("button", "action-button", bug.status === "open" ? "Fermer" : "Rouvrir");
  toggleButton.type = "button";
  toggleButton.setAttribute("aria-label", `${bug.status === "open" ? "Fermer" : "Rouvrir"} le bug : ${bug.title}`);
  toggleButton.addEventListener("click", () => {
    bug.status = bug.status === "open" ? "closed" : "open";
    saveBugs();
    render();
  });

  const deleteButton = makeElement("button", "action-button delete-button", "×");
  deleteButton.type = "button";
  deleteButton.setAttribute("aria-label", `Supprimer le bug : ${bug.title}`);
  deleteButton.addEventListener("click", () => {
    bugs = bugs.filter((item) => item.id !== bug.id);
    saveBugs();
    render();
  });

  titleLine.append(title, priority);
  meta.append(date, divider, status);
  main.append(titleLine, description, meta);
  actions.append(toggleButton, deleteButton);
  row.append(main, actions);
  return row;
}

function render() {
  const query = searchInput.value.trim().toLocaleLowerCase("fr");
  const selectedPriority = priorityFilter.value;
  const visibleBugs = bugs.filter((bug) => {
    const matchesTitle = bug.title.toLocaleLowerCase("fr").includes(query);
    const matchesPriority = selectedPriority === "all" || bug.priority === selectedPriority;
    return matchesTitle && matchesPriority;
  });
  const openCount = bugs.filter((bug) => bug.status === "open").length;
  const closedCount = bugs.length - openCount;

  document.querySelector("#open-count").textContent = openCount;
  document.querySelector("#closed-count").textContent = closedCount;
  document.querySelector("#total-count").textContent = bugs.length;
  document.querySelector("#total-plural").textContent = bugs.length > 1 ? "s" : "";
  document.querySelector("#visible-count").textContent = `${visibleBugs.length} affiché${visibleBugs.length > 1 ? "s" : ""}`;
  bugList.replaceChildren(...visibleBugs.map(renderBug));
  emptyState.hidden = visibleBugs.length > 0;
  bugList.hidden = visibleBugs.length === 0;

  if (bugs.length === 0) {
    document.querySelector("#empty-title").textContent = "Tout est calme.";
    document.querySelector("#empty-copy").textContent = "Ajoutez un incident pour commencer le suivi.";
  } else {
    document.querySelector("#empty-title").textContent = "Aucun résultat.";
    document.querySelector("#empty-copy").textContent = "Essayez une autre recherche ou priorité.";
  }
}

form.addEventListener("submit", (event) => {
  event.preventDefault();
  const title = titleInput.value.trim();
  const description = descriptionInput.value.trim();

  if (!title || !description) {
    formFeedback.textContent = "Renseignez un titre et une description.";
    return;
  }

  const nextId = bugs.reduce((maximum, bug) => Math.max(maximum, bug.id), 0) + 1;
  bugs.unshift({
    id: nextId,
    title,
    description,
    priority: priorityInput.value,
    status: "open",
    createdAt: new Date().toISOString().slice(0, 10),
  });
  saveBugs();
  form.reset();
  priorityInput.value = "medium";
  formFeedback.textContent = "Bug ajouté au tableau.";
  render();
  titleInput.focus();
});

priorityFilter.addEventListener("change", render);
searchInput.addEventListener("input", render);
render();