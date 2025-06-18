function searchFood(){
    var input = document.getElementById('searchInput').value.toLowerCase();
    var titleFoods = document.querySelectorAll('.food-title');
    titleFoods.forEach(function(titleFood){
        var titleName = titleFood.querySelector('h2');
        titleName.style.display='none';
        var foods = titleFood.querySelectorAll('.food-card');
        var count=0;
        foods.forEach(function(food){
            var title = food.querySelector('h3');
            var text= title.textContent.toLowerCase();
            if (text.includes(input)){
                food.style.display = 'block';
                count++;
            }
            else food.style.display = 'none';
        });
        if (count>0){
                titleName.style.display='block';
        }
    });
}