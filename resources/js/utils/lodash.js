import has from 'lodash-es/has'
import minBy from 'lodash-es/minBy'
import maxBy from 'lodash-es/maxBy'
import difference from 'lodash-es/difference'
import debounce from 'lodash-es/debounce'
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

export default {has,isEmpty, debounce, truncate, chunk, map, cloneDeep,uniq, minBy,maxBy,isNotEmpty, difference, uniqBy, isUndefined}
