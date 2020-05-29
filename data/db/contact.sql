-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th10 12, 2019 lúc 08:44 AM
-- Phiên bản máy phục vụ: 5.5.56-cll-lve
-- Phiên bản PHP: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `waeluxu8_luxury`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `contact`
--

CREATE TABLE `contact` (
  `cot_id` int(11) NOT NULL,
  `cot_full_name` varchar(255) DEFAULT NULL,
  `cot_email` varchar(255) DEFAULT NULL,
  `cot_phone` varchar(50) DEFAULT NULL,
  `cot_content` text,
  `cot_create_time` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `contact`
--

INSERT INTO `contact` (`cot_id`, `cot_full_name`, `cot_email`, `cot_phone`, `cot_content`, `cot_create_time`) VALUES
(1, 'Minh Trần Quang', 'tranminhtb93@gmail.com', '0363814855', 'ádad', 1554175331),
(2, 'Minh Trần Quang', 'tranminhtb93@gmail.com', '0363814855', 'ádad', 1554175333),
(3, 'Minh Trần Quang', 'tranminhtb93@gmail.com', '0363814855', 'ádad', 1554175334),
(4, 'Minh Trần Quang', 'tranminhtb93@gmail.com', '0363814855', 'ádad', 1554175356),
(5, 'minh', '363814855', 'tranminhtb93@gmail.com', 'ada skhdahdlashdlashdlasd', 1555468622),
(6, '123', '123', '', '', 1555486485),
(7, 'KevinNek', '83437395975', 'raphaefove@gmail.com', 'Hi!  aeluxury.vn \r\n \r\nWe advance \r\n \r\nSending your message through the feedback form which can be found on the sites in the Communication partition. Contact form are filled in by our software and the captcha is solved. The superiority of this method is that messages sent through feedback forms are whitelisted. This technique increases the probability that your message will be open. \r\n \r\nOur database contains more than 25 million sites around the world to which we can send your message. \r\n \r\nThe cost of one million messages 49 USD \r\n \r\nFREE TEST mailing of 50,000 messages to any country of your choice. \r\n \r\n \r\nThis message is automatically generated to use our contacts for communication. \r\n \r\n \r\n \r\nContact us. \r\nTelegram - @FeedbackFormEU \r\nSkype  FeedbackForm2019 \r\nEmail - FeedbackForm@make-success.com \r\nWhatsApp - +44 7598 509161', 1565140783),
(8, 'MichaelMab', '85951439719', 'noreplymonkeydigital@gmail.com', 'Hi there \r\nThe Local SEO package is built to rank local keywords for your local business in the google search and in google maps. We have researched for years what local SEO activities truly work and have put all in one single local SEO plan to accomplish the expected results and more. You will start seeing big increases in ranks from the 1st month of work already. You get monthly SEO reports and benchmark reports. \r\n \r\nhttps://monkeydigital.co/product/local-seo-package/ \r\n \r\nThanks and regards \r\nMike \r\nMonkey Digital \r\nmonkeydigital.co@gmail.com', 1566801584),
(9, 'RonaldFlife', '81748147573', 'Anounumis@gmail.com', 'Lay eyes on is  a frailoffers for you. http://terlacalrai.tk/m9k3', 1567642330),
(10, 'AverySiz', '84525345991', 'raphaefoloubs@gmail.com', 'Hello!  aeluxury.vn \r\n \r\nHave you ever heard of sending messages via feedback forms? \r\n \r\nThink of that your offer will be readread by hundreds of thousands of your potential future userscustomers. \r\nYour message will not go to the spam folder because people will send the message to themselves. As an example, we have sent you our offer  in the same way. \r\n \r\nWe have a database of more than 30 million sites to which we can send your letter. Sites are sorted by country. Unfortunately, you can only select a country when sending a offer. \r\n \r\nThe cost of one million messages 49 USD. \r\nThere is a discount program when you purchase  more than two million letter packages. \r\n \r\n \r\nFree trial mailing of 50,000 messages to any country of your choice. \r\n \r\n \r\nThis offer is created automatically. Please use the contact details below to contact us. \r\n \r\n \r\n \r\nContact us. \r\nTelegram - @FeedbackFormEU \r\nSkype  FeedbackForm2019 \r\nEmail - Contact@feedbackmessages.com', 1568261923),
(11, 'George Martin', '(08) 8217 7514', 'george1@georgemartinjr.com', 'Would you be interested in submitting a guest post on georgemartjr.com or possibly allowing us to submit a post to aeluxury.vn ? Maybe you know by now that links are essential\r\nto building a brand online? If you are interested in submitting a post and obtaining a link to aeluxury.vn , let me know and we will get it published in a speedy manner to our blog.\r\n\r\nHope to hear from you soon\r\nGeorge', 1568291013),
(12, 'Ronaldbix', '82114962436', 'quickchain50@gmail.com', 'Profit +10% after 2 days \r\nThe minimum amount for donation is 0.0025 BTC. \r\nMaximum donation amount is 10 BTC. \r\n \r\nRef bonus 3 levels: 5%,3%,1% paying next day after donation \r\nhttps://quickchain.cc/', 1568401779),
(13, 'Robertnet', '84515925958', 'huyblockchain@gmail.com', 'Tạo, chia sẻ và nhúng các album, catalogue sản phẩm, sách, tạp chí trực tuyến, chuyển đổi các tệp PDF của bạn thành sách lật trình diễn trực tuyến tại website https://zalaa.me/', 1568793132),
(14, 'David Gomez', '83596326413', 'sergiodumass@gmail.com', 'Dearest in mind, \r\n \r\nI would like to introduce myself for the first time. My name is Barrister David Gomez Gonzalez, the personal lawyer to my late client. \r\nWho worked as a private businessman in the international field. In 2012, my client succumbed to an unfortunate car accident. My client was single and childless. \r\nHe left a fortune worth $12,500,000.00 Dollars in a bank in Spain. The bank sent me message that I have to introduce a beneficiary or the money in their bank will be confiscate. My purpose of contacting you is to make you the Next of Kin. \r\nMy late client left no will, I as his personal lawyer, was commissioned by the Spanish Bank to search for relatives to whom the money left behind could be paid to. I have been looking for his relatives for the past 3 months continuously without success. Now I explain why I need your support, I have decided to make a citizen of the same country with my late client the Next of Kin. \r\n \r\nI hereby ask you if you will give me your consent to present you to the Spanish Bank as the next of kin to my deceased client. \r\nI would like to point out that you will receive 45% of the share of this money, 45% then I would be entitled to, 10% percent will be donated to charitable organizations. \r\n \r\nIf you are interested, please contact me at my private contact details by Tel: 0034-604-284-281, Fax: 0034-911-881-353, Email: amucioabogadosl019@gmail.com \r\nI am waiting for your answer \r\nBest regards, \r\n \r\nLawyer: - David Gomez Gonzalez', 1569536023),
(15, 'Mikehuh', '83881154177', 'noreplyfoloubs@gmail.com', 'When you order 1000 backlinks with this service you get 1000 unique domains, Only receive 1 backlinks from each domain. All domains come with DA above 15-20 and with actual page high PA values. Simple yet very effective service to improve your linkbase and SEO metrics. \r\n \r\nOrder this great service from here today: \r\nhttps://monkeydigital.co/product/unique-domains-backlinks/ \r\n \r\nMultiple offers available \r\n \r\nthanks and regards \r\nMike \r\nmonkeydigital.co@gmail.com', 1570171817),
(16, 'Pedro Molina', '84633889419', 'pedrom@uicinsuk.com', 'Dear Sir, \r\nAm contacting you to partner with me to secure the life insurance of my late client, to avoid it being confiscated. For more information, please contact me on + 447452275874 or pedrom@uicinuk.com \r\nRegards \r\nPedro Molina', 1570278929),
(17, 'Georgealarf', '84219833913', 'raphaefove@gmail.com', 'Ciao!  aeluxury.vn \r\n \r\nWe offer \r\n \r\nSending your commercial offer through the feedback form which can be found on the sites in the contact partition. Contact form are filled in by our program and the captcha is solved. The profit of this method is that messages sent through feedback forms are whitelisted. This method raise the chances that your message will be read. \r\n \r\nOur database contains more than 35 million sites around the world to which we can send your message. \r\n \r\nThe cost of one million messages 49 USD \r\n \r\nFREE TEST mailing of 50,000 messages to any country of your choice. \r\n \r\n \r\nThis message is automatically generated to use our contacts for communication. \r\n \r\n \r\n \r\nContact us. \r\nTelegram - @FeedbackFormEU \r\nSkype  FeedbackForm2019 \r\nEmail - FeedbackForm@make-success.com', 1570284843),
(18, 'GeorgeThype', '85768298159', 'julie@intergotelecom.com', 'Hello there, \r\n \r\nThis is Julie from SMS.to, \r\n \r\nAs a licensed telecom company we can offer you unbeatable prices for SMS messaging in Asia and internationally. \r\n \r\nWe are having a special offer this month for new customers, \r\n \r\nCan you point me to the person responsible for marketing to discuss and share my special offer? \r\n \r\n \r\nJulie Poblador \r\nSenior Account Manager \r\nsales@sms.to | julie@sms.to \r\nhttp://www.sms.to/ \r\n+1 (914) 340-0700 \r\n+356 277 610 22 \r\n+357 22 000 522 \r\n+44 8008085314 \r\nSMS.to by Intergo Telecom Ltd', 1571205019),
(19, 'Mark Middleton', '0353 3500414', 'mark@markmidd.com', 'Hello there,\r\n         Do you consider your website promotion important and like to see remarkable results? \r\nThen, maybe you already discovered one of the easiest and proven ways \r\nto promote your website is by links. Search engines like to see links. \r\nMy site www.markmidd.com is looking to promote worthy websites. \r\n\r\nBuilding links will help to guarantee an increase in your ranks so you can go here\r\nto add your site for promotion and we will add your relevant link:\r\n\r\nwww.markmidd.com\r\n\r\nBest Regards,\r\n\r\nMark', 1571521813),
(20, 'RobertWrops', '85447887995', 'cbu@cyberdude.com', 'Hi aeluxury.vn admin, \r\n \r\n \r\nSee, ClickBank is going to BREAK the Internet. \r\nThey’re doing something SO CRAZY, it might just tear the Internet at its seams. \r\n \r\nInstead of selling our 3-Part “ClickBank Breaks The Internet” Extravaganza Series… They’re giving it to you at no cost but you need to get it now or it will be gone! \r\n \r\nGET YOUR COPY NOW! Download The “$1k Commission Manual\": https://1kmanual.com \r\n \r\nHere’s to kicking off the Fall season right!', 1571529597),
(21, 'Kevinpiply', '82781194389', 'rodgerPoity@outlook.com', 'hi there \r\nI have just checked aeluxury.vn for the ranking keywords and to see your SEO metrics and found that you website could use a boost. \r\n \r\nWe will improve your SEO metrics and ranks organically and safely, using only whitehat methods \r\n \r\nPlease check our pricelist here, we offer SEO at cheap rates. \r\nhttps://www.hilkom-digital.de/cheap-seo-packages/ \r\n \r\nStart boosting your business sales and leads with us, today! \r\n \r\nregards \r\nHilkom Digital Team \r\nsupport@hilkom-digital.de', 1572367427),
(22, 'Michaelbeway', '82355145355', 'robertCoelm@gmail.com', 'The legendary \"Eldorado\"investment Fund has returned to the international cryptocurrency market in your country. \r\n \r\n10% BTC to each member of the club \" Eldorado\" \r\n10 % accrual to your bitcoin wallet every 2 days. \r\n9% Daily bonus to each member of the affiliate program. \r\n \r\nFree registration only on the official website of \" Eldorado\" \r\nhttps://eldor.cc#engbtc ', 1572711513);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`cot_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `contact`
--
ALTER TABLE `contact`
  MODIFY `cot_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
