document.querySelector(".image-form").onsubmit = function (event) {
    event.preventDefault();

    if (document.querySelector("#images").files.length > 0) {
        const data = new FormData(this);
        fetch(this.action, {
            method: "post",
            body: data,
        });
    }
};
