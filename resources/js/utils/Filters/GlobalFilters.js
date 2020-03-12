import Vue from 'vue'

Vue.filter('shorten', function(value, length){
    return _.truncate(value, { length });
});

Vue.filter('naira', function(price,thousands=true){

    return `₦ ${(price/ (thousands ? 100 :1)).toLocaleString('en-NG',{minimumFractionDigits: 2})}`;
});

Vue.filter('capitalize', function(string){
    return string.charAt(0).toUpperCase() + string.slice(1)
});

Vue.filter('separateKebab', function(string){
    let arrayfiedString = string.split("_");
    if(arrayfiedString.length > 1){
    return arrayfiedString.join(" ")
    }else{
        return string;
    }
});

Vue.filter('joinStrings', function(string){
    let arrayfiedString = string.split(" ");
    if(arrayfiedString.length > 1){
    return arrayfiedString.join("")
    }else{
        return string;
    }
});

Vue.filter('bytesToMB', function(value){
    return ((value / 1024) / 1000).toFixed(3) + " MB"
});

Vue.filter('getExtFromFileName', function(name){
    return extractValueFromText(name,".")
});

Vue.filter('getNameFromUrl', function(url){
    return extractValueFromText(url,"/")
});

Vue.filter('truncateThousand', function(value){
    if(Number.parseInt(value) >=9999){
        return Math.floor(value/1000) + 'K'
    }
    return numberInThousand(value);
});

Vue.filter('numberInThousand', function(number){
    return numberInThousand(number)
});

Vue.filter('birthdayString', function(birthday){
    return `${monthsMap[birthday['month']]} ${birthday['day']}`
});

Vue.filter('textAvatar', function(text){
    if(text){
        let avatar = "";
        let textArray = text.split(" ");
        textArray.forEach(text=>{
            avatar += text[0].toUpperCase();
        });
        return avatar;
    }
});

let monthsMap  = {
    1: "January",
    2: "February",
    3: "March",
    4: "April",
    5: "May",
    6: "June",
    7: "July",
    8: "August",
    9: "September",
    10: "October",
    11: "November",
    12: "December",
}
function numberInThousand(number) {
    return number.toLocaleString('en-NG',{minimumFractionDigits: 0});
}
