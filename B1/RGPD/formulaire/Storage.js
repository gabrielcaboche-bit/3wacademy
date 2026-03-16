class Storage {

    static setItem(key, value) {
        if (Array.isArray(key)) {
            for (const pair of key) {
                if (Array.isArray(pair) && pair.length >= 2) {
                    sessionStorage.setItem(pair[0], pair[1]);
                }
            }
            return;
        }
        sessionStorage.setItem(key, value);
    }

    static getItem(key) {
        return sessionStorage.getItem(key);
    }

    static removeItem(key) {
        sessionStorage.removeItem(key);
    }

    static getAllItems() {
        const items = {};
        for (let i = 0; i < sessionStorage.length; i++) {
            const key = sessionStorage.key(i);
            items[key] = sessionStorage.getItem(key);
        }
        return items;
    }
}

export default Storage;