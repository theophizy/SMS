function positiveNumbers(arry){
//const arry = [-2.5699, -1.4589, -3.2447, -6.9789, -9.213568];
const positive = arry.map(s => Math.abs(s));
return positive;
console.log(arry);
}

var arr = [1,2,3];
var max = arr.reduce(function(a, b) {
    return Math.max(a, b);
}, 0);

function arrayMin(arr) {
  return arr.reduce(function (p, v) {
    return ( p < v ? p : v );
  });
}

function arrayMax(arr) {
  return arr.reduce(function (p, v) {
    return ( p > v ? p : v );
  });
}

var difference = function (a, b) { 
return Math.abs(a - b); 
}