window.addEventListener('load', (event) => {
    let loader = document.querySelector(".initial-page-loader");
    if(loader){
         loader.style.animation = "remove 4s";
        setTimeout(()=>{
            let mainLayout = document.querySelector("div.q-layout.q-layout--standard");
            mainLayout.style.display = "inherit";
            document.querySelector("div.loader-wrapper").remove();
            loader.remove();
        },100)
    }
});
