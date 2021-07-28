-- @block 
CREATE TABLE Users(
userid INT PRIMARY KEY AUTO_INCREMENT,
full_name VARCHARACTER(255),
points INT
);

-- @BLOCK
INSERT INTO usersinfo(full_name,points)
VALUES(
    "user2",
    0
);

-- @BLOCK
CREATE TABLE RecycledItems(
    item_id INT AUTO_INCREMENT,
    item_name VARCHARACTER(20),
    user_id INT,
    item_count INT,
    PRIMARY KEY (item_id),
    FOREIGN KEY (user_id) references Users(userid)
);

-- @BLOCK
INSERT INTO recycleditems(item_name,userid,item_count)
VALUES
    ('Paper',1,1);

-- @BLOCK
CREATE TABLE RecyclingFacts(    
    fact_id INT PRIMARY KEY AUTO_INCREMENT,
    fact_text VARCHARACTER(300)
);


-- @BLOCK
INSERT INTO recyclingfacts(fact_text)
VALUES
    ("recyclenow");
    

