function appendPath() {
    console.log("aaa");
    const fileInput = document.getElementById("fileInput");
    const fullPath = fileInput.value;

    const hiddenPathField = document.createElement("input");
    hiddenPathField.type = "hidden";
    hiddenPathField.name = "fullPath";
    hiddenPathField.value = fullPath;

    const form = document.querySelector("form");
    form.appendChild(hiddenPathField);
}
