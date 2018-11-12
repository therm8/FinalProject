-- Database: `FinalProjectDB`
--

-- --------------------------------------------------------

--
-- Table structure for table `Expressions`
--

CREATE TABLE `Expressions` (
  `expression` varchar(400) NOT NULL,
  `explanation` varchar(500) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Expressions`
--

INSERT INTO `Expressions` (`expression`, `explanation`, `status`) VALUES
('A bird in the hand is worth two in the bush', 'What you have is worth more than what you might have later', 'A'),
('A blessing in disguise', 'A good thing that seemed bad at first', 'A'),
('A dime a dozen', 'Something common', 'A'),
('A penny for your thoughts', 'Tell me what you\'re thinking', 'A'),
('A perfect storm', 'The worst possible situation', 'A'),
('A picture is worth 1000 words', 'Better to show than tell', 'A'),
('Actions speak louder than words', 'Believe what people do and not what they say', 'A'),
('Beat around the bush', 'Avoid saying what you mean, usually because it is uncomfortable', 'A'),
('Better late than never', 'Better to arrive late than not to come at all', 'A'),
('Bite off more than you can chew', 'Take on a project that you cannot finish', 'A'),
('Bite the bullet', 'To get something over with because it is inevitable', 'A'),
('Break a leg', 'Good luck', 'P'),
('Break the ice', 'Make people feel more comfortable', 'A'),
('By the skin of your teeth', 'Just barely', 'A'),
('Call it a day', 'Stop working on something', 'A'),
('Close but no cigar', 'To almost do something successfully, but not quite', 'A'),
('Comparing apples to oranges', 'Comparing two things that cannot be compared', 'A'),
('Cutting corners', 'Doing something poorly in order to save time or money', 'A'),
('Don\'t count your chickens before they hatch', 'Don\'t count on something good happening until it\'s happened', 'A'),
('Don\'t put all your eggs in one basket', 'What you\'re doing is too risky', 'A'),
('Every cloud has a silver lining', 'Good things come after bad things', 'A'),
('Get a taste of your own medicine', 'Get treated the way you\'ve been treating others (negative)', 'A'),
('Get out of hand', 'To become chaotic and unmanageable, as of a situation', 'A'),
('Give someone the cold shoulder', 'Ignore someone', 'A'),
('Go back to the drawing board', 'Start over', 'A'),
('Go on a wild goose chase', 'To do something pointless', 'A'),
('Hang in there', 'Do not give up', 'A'),
('He has bigger fish to fry', 'He has bigger things to take care of than what we are talking about now', 'A'),
('Hit the nail on the head', 'Get something exactly right', 'A'),
('Hit the sack', 'Go to sleep', 'A'),
('I hate this class!', 'Hate it!', 'P'),
('Ignorance is bliss', 'You\'re better off not knowing', 'A'),
('It ain\'t over till the fat lady sings', 'This isn\'t over yet', 'A'),
('It is not rocket science', 'It is not complicated', 'A'),
('It takes one to know one', 'You\'re just as bad as I am', 'A'),
('It\'s a piece of cake', 'It\'s easy', 'A'),
('It\'s raining cats and dogs', 'It\'s raining hard', 'A'),
('Kill two birds with one stone', 'Get two things done with a single action', 'A'),
('Let someone off the hook', 'To not hold someone responsible for something', 'A'),
('Let the cat out of the bag', 'Give away a secret', 'A'),
('Make a long story short', 'Tell something briefly', 'A'),
('Miss the boat', 'It is too late', 'A'),
('No pain, no gain', 'You have to work for what you want', 'P'),
('Not here to fuck spiders', 'To take something very seriously', 'P'),
('On the ball', 'Doing a good job', 'A'),
('Once in a blue moon', 'Rarely', 'A'),
('Rain on someone\'s parade', 'To spoil something', 'A'),
('Speak of the devil', 'The person we were just talking about showed up', 'A'),
('Take it with a grain of salt', 'Don’t take it too seriously', 'A'),
('The best thing since sliced bread', 'A really good invention', 'A'),
('The elephant in the room', 'The big issue, the problem people are avoiding', 'A'),
('The whole nine yards', 'Everything, all the way', 'A'),
('There are other fish in the sea', 'It\'s ok to miss this opportunity. Others will arise', 'A'),
('There\'s a method to his madness', 'He seems crazy but actually he\'s clever', 'A'),
('There\'s no such thing as a free lunch', 'Nothing is entirely free', 'A'),
('Throw caution to the wind', 'Take a risk', 'A'),
('You can\'t have your cake and eat it too', 'You can\'t have everything', 'A'),
('You can\'t judge a book by its cover', 'This person or thing may look bad, but it\'s good inside', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `Favourites`
--

CREATE TABLE `Favourites` (
  `username` varchar(50) NOT NULL,
  `expression` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Favourites`
--

INSERT INTO `Favourites` (`username`, `expression`) VALUES
('gaga', 'Call it a day'),
('ibra', 'Call it a day'),
('ibra', 'Hang in there'),
('ibra', 'hej'),
('therm', 'A blessing in disguise'),
('therm', 'A dime a dozen'),
('therm', 'Bite the bullet'),
('therm', 'Close but no cigar');

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `username` varchar(50) NOT NULL,
  `passwrd` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`username`, `passwrd`) VALUES
('DonaldTrump', '$2y$10$2kPNW5qEQVyp4WdAHKsRoet8IPUcJgR9TPj3DcB1a1vQfuG7CrVIq'),
('gaga', '$2y$10$Z26mviIC4tZ/LWpno2ua..HAXN8r4bbrClBVDeUXi6VCb6ftavWCS'),
('herm', '$2y$10$sIIwsp4E9GyPXwA3TnuX6uA2xM0o1K5P8jqVnwY4gq610oyvYgFkK'),
('ibra', '$2y$10$xX2w2D8JCx6wpfbHZr4Hw.6805skoQcBwtnIzJpSQPRoyvvoXsGO.'),
('therm', '$2y$10$rs7Ig5THXvNJund.Hhj5YOFRHA9RxUPhxgojJwisYEWVtzm625pbi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Expressions`
--
ALTER TABLE `Expressions`
  ADD PRIMARY KEY (`expression`);

--
-- Indexes for table `Favourites`
--
ALTER TABLE `Favourites`
  ADD PRIMARY KEY (`username`,`expression`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`username`);
