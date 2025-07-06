// function renderStars(rating) {
//   const fullStar = '★';
//   const emptyStar = '☆';
//   return fullStar.repeat(rating) + emptyStar.repeat(5 - rating);
// }

// document.getElementById("rating").innerText = renderStars(5);

document.addEventListener("DOMContentLoaded", () => {
    const ratingBtns= document.querySelectorAll(".attri-star");
    ratingBtns.forEach(btn => {
        btn.addEventListener("click", () => {
            const rating= parseInt(btn.dataset.value);
            ratingBtns.forEach((r, index) =>{
                r.textContent =index <rating ? '★' : '☆';
            });
        });
    });
});