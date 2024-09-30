const form = document.querySelector(".sendMess"),
  inputMess = document.querySelector(".input-field"),
  btnMess = document.querySelector(".submitMess"),
  chatbox = document.querySelector(".contentChat");
form.addEventListener("submit", (e) => {
  e.preventDefault();
});
function scrolltoBottom() {
  chatbox.scrollTo({
    top: chatbox.scrollHeight,
    behavior: "smooth", //  thuộc tính để cuộn mượt mà
  });
}

//--- add mess in frame chat
btnMess.addEventListener("click", () => {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "php/addMess.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        scrolltoBottom();
        inputMess.value = "";
      }
    }
  };
  let formData = new FormData(form);
  xhr.send(formData);
});

chatbox.addEventListener("mouseenter", () => {
  chatbox.classList.add("auto");
});
chatbox.addEventListener("mouseleave", () => {
  chatbox.classList.remove("auto");
});

// ! kéo tin nhắn giữa A-B về khung chat
setInterval(() => {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "php/showMess.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        chatbox.innerHTML = data;
        if (!chatbox.classList.contains("auto")) {
          scrolltoBottom();
        }
      }
    }
  };
  let formData = new FormData(form);
  xhr.send(formData);
}, 500);
