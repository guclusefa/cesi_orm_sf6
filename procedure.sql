CREATE PROCEDURE getDevelopersByGameId(IN game_id INT)
BEGIN
    SELECT developer.designation FROM developer
    INNER JOIN game_developer ON developer.id = game_developer.developer_id
    WHERE game_developer.game_id = game_id;
END