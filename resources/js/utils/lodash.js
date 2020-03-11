import has from 'lodash-es/has'
import minBy from 'lodash-es/minBy'
import maxBy from 'lodash-es/maxBy'
import difference from 'lodash-es/difference'
import isEmpty from 'lodash-es/isEmpty'
import truncate from 'lodash-es/truncate'
import chunk from 'lodash-es/chunk'
import map from 'lodash-es/map'
import cloneDeep from 'lodash-es/cloneDeep'
import uniq from 'lodash-es/uniq';
import uniqBy from 'lodash-es/uniqBy';
import isUndefined from 'lodash-es/isUndefined';


let isNotEmpty = (value)=>{
  return ! isEmpty(value);
};
let debouncedTimer = 0;
let debounce = (func, timeout)=>{

    clearTimeout(debouncedTimer);

    debouncedTimer = setTimeout(()=>{
        func();
    },timeout)

};

let isEmail = (email) =>{
    let regex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return regex.test(String(email).toLowerCase());
}
export default {has,isEmpty, debounce, isEmail, truncate, chunk, map, cloneDeep,uniq, minBy,maxBy,isNotEmpty, difference, uniqBy, isUndefined}
