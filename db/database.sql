CREATE DATABASE movie_trailer_db;

USE movie_trailer_db;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE movies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    image_path VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    trailer_path VARCHAR(255) NOT NULL,
    rating VARCHAR(10) NOT NULL
);

-- Insert sample data
INSERT INTO movies (title, image_path, description, trailer_path, rating)
VALUES
('Dune: Part two', 'images/movie1.jpg', 'Paul Atreides unites with the Fremen while on a warpath of revenge against the conspirators who destroyed his family. Facing a choice between the love of his life and the fate of the universe, he endeavors to prevent a terrible future.', 'trailers/trailer1.mp4', 'PG-13'),
('Furiosa: A Mad Max Saga', 'images/movie2.jpg', 'The origin story of renegade warrior Furiosa before her encounter and teamup with Mad Max.', 'trailers/trailer2.mp4', 'R'),
('Inside Out 2', 'images/movie3.jpg', 'A sequel that features Riley entering puberty and experiencing brand new, more complex emotions as a result. As Riley tries to adapt to her teenage years, her old emotions try to adapt to the possibility of being replaced.', 'trailers/trailer3.mp4', 'PG'),
('The Substance', 'images/movie4.jpg', 'A fading celebrity takes a black-market drug: a cell-replicating substance that temporarily creates a younger, better version of herself.', 'trailers/trailer4.mp4', 'R'),
('The Brutalist', 'images/movie5.jpg', 'When visionary architect László Toth and his wife Erzsébet flee post-war Europe in 1947 to rebuild their legacy and witness the birth of modern America, their lives are changed forever by a mysterious and wealthy client.', 'trailers/trailer5.mp4', 'NR'),
('The Outrun', 'images/movie6.jpg', 'After living life on the edge in London, Rona attempts to come to terms with her troubled past. Hoping to heal, she returns to the wild beauty of Scotlands Orkney Islands where she grew up.', 'trailers/trailer6.mp4', 'R'),
('Ghostlight', 'images/movie7.jpg', 'When a construction worker unexpectedly joins a local theaters production of Romeo and Juliet, the drama onstage starts to mirror his own life.', 'trailers/trailer7.mp4', 'R'),
('Young Woman and the Sea', 'images/movie8.jpg', 'The story of competitive swimmer Gertrude Ederle, who, in 1926, was the first woman to ever swim across the English Channel.', 'trailers/trailer8.mp4', 'PG'),
('Wicked', 'images/movie9.jpg', 'Elphaba, a misunderstood young woman because of her green skin, and Glinda, a popular girl, become friends at Shiz University in the Land of Oz. After an encounter with the Wonderful Wizard of Oz, their friendship reaches a crossroads.', 'trailers/trailer9.mp4', 'PG'),
('Challengers', 'images/movie10.jpg', 'Tashi, a former tennis prodigy turned coach, transformed her husband into a champion. But to overcome a recent losing streak and redeem himself, hell need to face off against his former best friend and Tashis ex-boyfriend.', 'trailers/trailer10.mp4', 'R');

