const listFriend = document.querySelectorAll(".friend");
console.log(listFriend);
if (listFriend.length >= 2) {
  for (let i = 0; i < listFriend.length - 1; i++) {
    listFriend[i].style.borderBottom = "1px solid #e6e6e6";
  }
}

// -------------------------------/
const valueInput = document.querySelector(".search-user input");
const clickDelete = document.querySelector(".search-user i");
valueInput.addEventListener("keyup", (e) => {
  if (e.key === "Enter") {
    // console.log("Nội dung tìm kiếm là: ", valueInput.value);
    valueInput.value = "";
  }
});
clickDelete.addEventListener("click", (e) => {
  // console.log("Nội dung tìm kiếm là: ", valueInput.value);
  valueInput.value = "";
});
