document.querySelector(".image-form").onsubmit = function (event) {
    event.preventDefault();
    const data = new FormData(this);

    if (document.querySelector("#images").files.length > 0) {
        fetch(this.action, {
            method: "post",
            body: data,
        });
    }
};
