
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
    // let popular = document.querySelector("#popular")
    // rows = {}
    document.querySelectorAll(".dish img").forEach(el=>{
        console.log(el.width)
        el.onload = e=>{
            const proportion = (el.clientWidth / el.clientHeight).toFixed(2)
            el.parentNode.style.flex = proportion
        }
        // const popular = dish.parentNode
        // if(!rows[proportion]) rows[proportion] = []
        // rows[proportion].push(el.parentElement)
    })
    // for(let row in rows) {
    //     const noDot = row.replace("0.", "")
    //     const numEls = rows[row].length

    //     $(rows[row]).wrapAll(`<div id="row${noDot}"></div>`)
    //     rows[row].forEach(dish=>{
    //         dish.childNodes[0].style.cssText = `width: calc(100vw / ${numEls}); height:auto;`
    //     })
    // }
}

else if(page == "dish_create" || page == "dish_edit") {
    //Jquery
    const tagDelete = $(".tags")
    checkTag()

    $("#delete-tags").click(function(e){
        if(e.target.checked) {
            tagDelete.unbind()
            deleteTag()
        } else {
            tagDelete.unbind()
            checkTag()
            tagDelete.removeClass("delete")
        }
    })

    function checkTag(){
        tagDelete.click(function(){
            const _this = $(this)
            if(!_this.hasClass("delete")){
                if(_this.children(".selectTag").prop("checked")) _this.addClass("added")
                else _this.removeClass("added")
            }
        })
    }
    function deleteTag(){
        tagDelete.addClass("delete").click(function(){
            const id = $(this).attr("category_id")
            const _this = this
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            $.ajax({
                method: "DELETE",
                url: `http://project3.josebric.com/dish/category/${id}`,
                success: function(response){
                    $(_this).hide()
                    console.log(response)
                },
                error: function(err){
                    console.log(err)
                }
            })
        })
    }

}
else if(page == "dashboard") {
    document.querySelector("#featuredBox").addEventListener("click", e=>{
        el = e.target
        const featuredBoxes = document.querySelectorAll(".featuredBox")
        if(el.checked) {
            featuredBoxes.forEach(chBox=>{
                chBox.style.display = "inline-block"
            })
        } else {
            featuredBoxes.forEach(chBox=>{
                chBox.style.display = "none"
            })
        }
    })

    $(".deleteBtn").click(el=>{
        const dish = el.target.closest(".dish")
        const id = dish.getAttribute("dish_id")
        dish.style.display = "none"
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
        $.ajax({
            method: "DELETE",
            url: `http://project3.josebric.com/dish/${id}`,
            dataType: "json",
            success: function(data) {
                console.log(data)
            },
            error: function(err){
                console.log(err)
            }
        })
    })
}

