// 印出因數
// 因數就是所有小於等於 n 又可以被 n 整除的數
// 換句話說，印出可以整除 i 的數


function printFactor(n) {
  for(let i=1; i<=n; i++){
    if(n % i === 0){
      console.log(i)
    }
  }
}

printFactor(10)
