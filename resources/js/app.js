
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

// const files = require.context('./', true, /\.vue$/i)

// files.keys().map(key => {
//     return Vue.component(_.last(key.split('/')).split('.')[0], files(key))
// })

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app'
});

//Custom
page = document.querySelector("body").id
if(page == "home") {
    $(window).scroll(function(){
        const navbar = $("#navbar")
        const navbarPos = navbar.offset().top
        const featured = $("#popular").offset().top
        if(navbarPos >= featured - navbar.height()) navbar.addClass("navbar-black")
        else navbar.removeClass("navbar-black")
    })
}

else if(page == "admin") {
    //Jquery
    let content = ""
    const tags = $(".tags")
    tags.hover(function(){
        const _this = $(this)
        _this.addClass("delete")
        content = _this.text()
        _this.text("Delete")
    
    }, function() {
        $(this).removeClass("delete").text(content)
    })

    tags.click(function(){
        const _this = $(this)
        const id = $(this).attr("category_id")
        $.ajax({
            method: "DELETE",
            url: "http://project3.josebric.com/api/category/" + id,
            dataType: "json"
        }).done(function(data){
            $(`.tags[category_id="${id}"]`).hide()
        })
    })
    //Vanilla
    const deleteBtn = document.querySelectorAll(".deleteBtn")
    deleteBtn.forEach(el=>{
        el.addEventListener("click", ()=>{
            const dish = el.closest(".dish")
            const dishId = dish.getAttribute("dish_id")
            fetch(`http://project3.josebric.com/api/dish/${dishId}`, {
                method: "DELETE"
            })
            .then(()=>{
                dish.style.cssText = "display: none";
            })
        })
    })
}