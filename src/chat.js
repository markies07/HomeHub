const form = document.querySelector(".typing_area"),
  incoming_id = form.querySelector(".incoming_id").value,
  messageBox = form.querySelector(".messageBox"),
  sendBtn = form.querySelector(".sendBtn"),
  chatBox = document.querySelector(".chatBox");

form.onsubmit = (e) => {
  e.preventDefault();
};

function scrollToBottom() {
  chatBox.scrollTop = chatBox.scrollHeight;
}

messageBox.focus();
messageBox.onkeyup = () => {
  if (messageBox.value != "") {
    sendBtn.classList.add("cursor-pointer");
    sendBtn.classList.remove("pointer-events-none");
    sendBtn.classList.add("bg-[#5e8a24]");
    sendBtn.classList.add("hover:bg-[#74aa2c]");
    sendBtn.classList.remove("bg-[#77ad30]");
  } else {
    sendBtn.classList.add("pointer-events-none");
    sendBtn.classList.remove("cursor-pointer");
    sendBtn.classList.add("bg-[#77ad30]");
    sendBtn.classList.remove("bg-[#5e8a24]");
  }
};

sendBtn.onclick = () => {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "insert-chat.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        messageBox.value = "";
        scrollToBottom();
      }
    }
  };
  let formData = new FormData(form);
  xhr.send(formData);
};

chatBox.onmouseenter = () => {
  chatBox.classList.add("active");
};

chatBox.onmouseleave = () => {
  chatBox.classList.remove("active");
};

setInterval(() => {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "get-chat.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        chatBox.innerHTML = data;
        if (!chatBox.classList.contains("active")) {
          scrollToBottom();
        }
      }
    }
  };
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send("incoming_id=" + incoming_id);
}, 500);
