export function problem (lines){
    const testes =lines[0];
    let a;
    for(let i = 1 ; i < testes ; i++){
        while(lines[i+1] > 0){
            a = lines[i+1];
            lines[i+1] = lines[i]%a;
            lines[i] = a;
        }
        console.log(lines[i]);
    }
}