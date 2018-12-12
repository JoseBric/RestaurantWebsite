require('./bootstrap');

window.Vue = require('vue');

Vue.component('example-component', require('./components/ExampleComponent.vue'));

const app = new Vue({
    el: '#app'
});

//Custom

//global
const navLinks = document.querySelector("#nav-links")
document.querySelector(".hamburgerButton").addEventListener("click", e=>{
    const el = e.target
    if(el.classList.contains("show")) {
        el.classList.remove("show")
        navLinks.classList.remove("show")
    } else {
        el.classList.add("show")
        navLinks.classList.add("show")
    }
})

page = document.querySelector("body").id

if(page == "home") {
    const navbar = $("#navbar")
    $(window).scroll(function(e){
        
        if(window.innerWidth >= 768) {
            if($(window).scrollTop() > 0) {
                navbar.fadeOut()
            } 
            else {
                navbar.fadeIn()
            }
        } else {
            navbar.fadeIn()
        }
    })
    


    document.querySelectorAll(".dish img").forEach(el=>{
        el.onload = e=>{
            const proportion = (el.clientWidth / el.clientHeight).toFixed(2)
            el.parentNode.style.flex = proportion
        }
    })

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

    const badge = document.querySelector("#featured-badge")
    document.querySelectorAll(".featuredBox").forEach(val=>{
        const dish = val.closest(".card")

        val.addEventListener("click", e=>{
            const xhr = new XMLHttpRequest()
            const dish_id = val.getAttribute("dish_id")
            if(e.target.checked) {
                xhr.open("PUT", `/dish/${dish_id}/featured`)
                xhr.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200) {
                        badge.innerHTML++
                        dish.classList.add("featured_dish")
                    }
                }
                xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'))
                xhr.send()
            } else {
                xhr.open("PUT", `/dish/${dish_id}/unfeatured`)
                xhr.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200) {
                        badge.innerHTML--
                        dish.classList.remove("featured_dish")
                    }
                }
                xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'))
                xhr.send()
            }
        })
    })
}

else if(page == "about_us") {
    const h1 = $("h1")
    $(window).scroll(function(){
        if($(window).scrollTop() > 0) {
            h1.removeClass("fadeIn")
            h1.addClass("fadeOut")
        } 
        else {
            h1.removeClass("fadeOut")
            h1.addClass("fadeIn")
        }
    })
}
else if(page == "locations") {
    let map;
    const state = document.querySelector("#state")
    const city = document.querySelector("#city")
    const restaurant = document.querySelector("#restaurant")
    selectState()
    function selectState() {
        state.addEventListener("change", e => {
            e.target.querySelectorAll("option").forEach(el => {
                if(el.selected) {
                    const state_id = el.getAttribute("state_id")
                    fetch(`/locations/${state_id}/state`, {
                        method: "POST",
                        headers: {'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}
                    }).then(res=>res.json())
                        .then(arr=>{
                            city.style.visibility = "visible"
                            arr.forEach(json=>{
                                city.innerHTML += 
                                `
                                <option value="${json.name}" city_id="${json.id}">${json.name}</option>
                                `
                            })
                            selectCity()
                        })
                }
            })
        })
    }

    function selectCity() {
        city.addEventListener("change", e => {
            e.target.querySelectorAll("option").forEach(el => {
                if(el.selected) {
                    const city_id = el.getAttribute("city_id")
                    fetch(`/locations/${city_id}/city`, {
                        method: "POST",
                        headers: {'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}
                    }).then(res=>res.json())
                        .then(arr=>{
                            restaurant.style.visibility = "visible"
                            arr.forEach(json=>{
                                restaurant.innerHTML += 
                                `
                                <option value="${json.name}" lat="${json.latitude}" lng="${json.longitude}" restaurant_id="${json.id}">${json.street} #${json.ext_num} - Zip Code: ${json.zip_code}</option>
                                `
                            })
                            selectRestaurant()
                        })
                }
            })
        })
    }

    function selectRestaurant() {
        restaurant.addEventListener("change", e => {
            e.target.querySelectorAll("option").forEach(el => {
                if(el.selected) {
                    const lat = parseFloat(el.getAttribute("lat"))
                    const lng = parseFloat(el.getAttribute("lng"))
                    const latLng = {lat: lat, lng: lng}
                    // const map = new google.maps.Map(document.getElementById('map'), {
                    //     center: latLng,
                    //     zoom: 15
                    // })
                    // new google.maps.Marker({
                    //     position: latLng,
                    //     map: map,
                    //     title: "Restaurant"
                    // })
                }
            })
        })
    }
}