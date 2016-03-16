public class Main {



public static String results(Integer[][] matches){
    Integer percentWin = 0;
    Integer percentLoss = 0;
    Integer percentTie = 0;
    Integer amountOfMatches = 13;


Integer win=0; //added by me
Integer lost=0; //added by me
Integer tie=0; //added by me

    for (int i = 0; i<13; i++){
        Integer nrMatch = i;
        Integer[] match_result;


        //added by from here down

        match_result =matches[i]; 
        System.out.println(match_result);

        //match_result[0]=1; //I gave a value to the positions to check if the math for the % was OK, but I don't know how to use the values displayed in main array of scores.
        //match_result[1]=2; 


            if (match_result[0]>match_result[1]) 
            win++;
            else if (match_result[0]<match_result[1])
            lost++;
            else
            tie++;


        percentWin= (win/amountOfMatches)*100;
        percentLoss= (lost/amountOfMatches)*100;
        percentTie= (tie/amountOfMatches)*100;

    }





    return "Wins: " + percentWin + " Losses: " + percentLoss + " Ties: " + percentTie;
}


public static void main(String args[]){

    Integer[][] matches = {{2,2},{3,2},{4,1},{1,3},{3,5},{1,1},{1,0},{0,0},{1,2},{0,2},{0,3},{3,3},{1,0}};
    Main m = new Main();
    System.out.println(m.results(matches));

}



}
