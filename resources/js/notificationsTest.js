function notifyMe() {
    Notification.requestPermission().then(perm => {
        if (perm === "granted") {
            new Notification("Hi there!")
        }
    }); 
}