const listFriend = document.querySelectorAll(".friend");
const listFR = document.querySelector(".listFriends");
// console.log(listFriend);
if (listFriend.length >= 2) {
  for (let i = 0; i < listFriend.length - 1; i++) {
    listFriend[i].style.borderBottom = "1px solid #e6e6e6";
  }
}

// const statusUser = document.querySelectorAll(".stt-user");
// statusUser.forEach((item) => {
//   if (item.textContent.trim() === "Online now") {
//     item.style.color = "#05057d";
//   } else if (item.textContent.trim() === "Offline") {
//     item.style.color = "#a19e9e";
//   }
// });
// -------------------------------/
const valueInput = document.querySelector(".search-user input");

valueInput.addEventListener("keyup", (e) => {
  let valueSearch = valueInput.value;
  if (valueSearch != "") {
    valueInput.classList.add("active");
  } else {
    valueInput.classList.remove("active");
  }
  //! ajax xử lí tìm kiếm user và trả về danh sách người dùng
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "php/search.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        listFR.innerHTML = data;
      }
    }
  };
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send("valueSearch=" + valueSearch);
});


// ----------------------------------------
setInterval(() => {
  let xhr = new XMLHttpRequest();
  xhr.open("GET", "php/getUser.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        if (!valueInput.classList.contains("active")) {
          listFR.innerHTML = data;
        }
      }
    }
  };
  xhr.send();
}, 500);
