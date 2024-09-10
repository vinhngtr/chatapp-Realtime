const listFriend = document.querySelectorAll(".friend");
console.log(listFriend);
if (listFriend.length >= 2) {
  for (let i = 0; i < listFriend.length - 1; i++) {
    listFriend[i].style.borderBottom = "1px solid #e6e6e6";
  }
}