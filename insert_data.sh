#! /bin/bash

if [[ $1 == "test" ]]
then
  PSQL="psql --username=postgres --dbname=worldcuptest -t --no-align -c"
else
  PSQL="psql --username=freecodecamp --dbname=worldcup -t --no-align -c"
fi

# Do not change code above this line. Use the PSQL variable above to query your database.
echo $($PSQL "truncate games, teams")
cat games.csv | while IFS="," read YEAR ROUND WINNER OPPONENT WINNER_GOALS OPPONENT_GOALS
do
  if [[ $YEAR != year ]]
  then
    WINNER_ID=$($PSQL "SELECT team_id from teams where name = '$WINNER'")
    OPPONENT_ID=$($PSQL "SELECT team_id from teams where name = '$OPPONENT'")
    if [[ -z $WINNER_ID ]]
    then
      INSERT_WINNER=$($PSQL "insert into teams(name) values ('$WINNER')")
      if [[ $INSERT_WINNER == "INSERT 0 1" ]]
      then
        echo "Inserted team: " $WINNER
      fi
      WINNER_ID=$($PSQL "select team_id from teams where name = '$WINNER'")
    fi
    if [[ -z $OPPONENT_ID ]]
    then
      INSERT_OPPO=$($PSQL "insert into teams(name) values ('$OPPONENT')")
      if [[ $INSERT_OPPO == "INSERT 0 1" ]]
      then
        echo "Inserted team: " $OPPONENT
      fi
      OPPONENT_ID=$($PSQL "select team_id from teams where name = '$OPPONENT'") 
    fi
    INSERT_TOTAL=$($PSQL "insert into games(year, winner_id, opponent_id, winner_goals, opponent_goals, round) values ($YEAR, $WINNER_ID, $OPPONENT_ID, $WINNER_GOALS, $OPPONENT_GOALS, '$ROUND')")
    if [[ $INSERT_TOTAL == "INSERT 0 1" ]]
    then
      echo "Inserted Game of $YEAR: (" $ROUND ") " $WINNER " - " $OPPONENT $WINNER_GOALS ":" $OPPONENT_GOALS
    fi
  fi
done
