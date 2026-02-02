function toggle()
{
    document.querySelector("p").classList.toggle("d-none");
    alert("le bouton a été cliqué")
    console.log("modifier de la visbilité de paragraphe")
}

document.querySelector(".js-toggle" , toggle)


