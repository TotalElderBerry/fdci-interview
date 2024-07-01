function checkLoggedIn() {
    const token = get('id');
    if (token) {
        return token;
    } else {
       return null;
    }
}

function store(name, value){
    localStorage.setItem(name,value);
}

function get(name){
    const token = localStorage.getItem(name);
    return token;
}

function remove(name){
    localStorage.removeItem(name);
}