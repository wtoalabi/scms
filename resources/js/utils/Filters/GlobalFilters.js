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
