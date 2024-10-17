

INSERT INTO admin (admin_name, password) VALUES
('testadmin', '$2y$10$XOdKhQm0YIZJ1JScVptmxOc6F/1VvR2ZaLpST5iRwHAbFZYIvWRWK');


INSERT INTO category ('name_category') VALUES
('Afterboss'),
('Entrepreneur2demain'),
('Les Pépés Flingueurs'),
('Mouvement'),
('Outside the box');

INSERT INTO formation (name, subtitle, description, specification, date1_, date2_, date3_, time, localisation, nb_participants, price, reduce_price, id_sub_category, id_category, id_host) VALUES
('Cursus 3 jours', '', 'Au centre de ce cursus, la question de la création d’entreprise selon trois axes : le management d’entreprise, le besoin financier, mon offre et son marché. Trois jours pour affiner et peut-être valider son « go ».', '', '1970-01-01', '1970-01-01', '1970-01-01', 'RDV en 2025', '', NULL, 0, NULL, 5, 2, 2),
('Cursus 5 jours', 'Prêt.e à sauter le pas ?', 'Cette formation s’articule autour de deux pôles principaux : les questions administratives et financières liées à la création et à son business plan, les questions marketing avec, en particulier, son offre, sa place sur le marché et sa propre image de marque.', '', '2024-11-11', '2024-12-12', '1970-01-01', '', 'Caen', NULL, 0, NULL, 4, 2, 2),
('“Maîtriser son image publique”', '', '', '', '2024-11-05', '1970-01-01', '1970-01-01', 'de 18h à 19h30', 'Caen', 0, 85, 68, 13, 4, 1),
('“Faire de son entreprise une marque”', '', '', '', '2024-12-17', '1970-01-01', '1970-01-01', '18h à 19h30', 'Caen', 0, 85, 68, 13, 4, 1),
('“Adapter sa gestion financière à la situation actuelle”', '', '', '', '2024-11-26', '1970-01-01', '1970-01-01', '18h à 19h30', 'Caen', 0, 85, 68, 13, 4, 1),
('“Croire en soi”', '', '', '', '2024-11-04', '1970-01-01', '1970-01-01', 'de 18h à 19h30', 'Caen', 0, 0, 0, 13, 5, 1),
('“Etre acteur de sa vie”', '', '', '', '2024-11-25', '1970-01-01', '1970-01-01', '18h à 19h30', 'Caen', 0, 0, 0, 13, 5, 1),
('“Investir mon avenir”', '', '', '', '2024-12-16', '1970-01-01', '1970-01-01', '18h à 19h30', 'Caen', 0, 0, 0, 13, 5, 1),
('“Je suis Superman, même pas peur, même pas mal !”', 'ou comment en finir avec l’injonction d’exemplarité', 'Être entrepreneur.se est une charge sociale très lourde, le regard des autres, l’injonction à la perfection. Très lourd ? Trop lourd ?', '', '2024-11-18', '1970-01-01', '1970-01-01', 'de 18h30 à 20h', 'Caen', 0, 185, 0, 1, 1, 1),
('“J’aime pas mes associés”', 'ou comment traiter l’épineux problème de l’association', 'Notre société encourage la création d’entreprise aux ambitions fortes, à l’image solide et aux promesses de performances. La contrepartie, le prix à payer parfois est de devoir…… s’associer\r\nCause ou conséquence, l’association, le projet collectif devient incontournable.\r\nLe mariage est-il un impératif ?', '', '2024-11-12', '1970-01-01', '1970-01-01', 'de 18h30 à 20h', 'Caen', 0, 150, 0, 1, 1, 17),
('“J’ai connu l’échec… c’est une maladie incurable, docteur?”', 'ou comment enfin lever le tabou des soi-disant échecs', 'En France, aujourd’hui, le droit à l’erreur est interdit alors même que l’on répète sans cesse que l’on apprend de ses erreurs ! Et si le véritable échec n’était de rien tenter ?', '', '2024-11-21', '1970-01-01', '1970-01-01', 'de 18h30 à 20h', 'Caen', 0, 185, 0, 1, 1, 1),
('“Comment vivre avec la trouille du procès ou de la plainte à tout moment ?”', 'ou comment gérer la peur de la judiciarisation de mes activités professionnelles', 'Litige, procès, vous craignez les difficultés avec vos partenaires, vos salariés ? Cette préoccupation vous mine, vous bouffe votre mental. Elle freine votre activité professionnelle, votre déploiement commercial. Des solutions, des réponses efficaces et faciles à mettre en œuvre existent. A quand la fin des procédures ?', '', '2024-12-10', '1970-01-01', '1970-01-01', 'de 18h30 à 20h', 'Caen', 0, 150, 0, 1, 1, 17),
('“J’aime plus les gens, ras le bol du management…”', 'ou comment rester ouvert à la relation humaine sans risquer la saturation', 'Le management humain est fait de bonheurs … autant que d’échecs, de déceptions et de difficultés. Des risques d’amertume, de méfiance de colère aussi nous guettent… Comment dépasser ce « ras le bol » ?', '', '2024-12-18', '1970-01-01', '1970-01-01', 'de 18h30 à 20h', 'Caen', 0, 185, 0, 1, 1, 1),
('Avant de parler salaire, parlons coûts cachés des salariés !', '', 'Un après-midi pour mesurer le coût réel du salariat… Au-delà du net, des charges sociales … avez-vous calculé « avance de trésorerie sur compétences », levé les tabous des choix managériaux, combien coûte l’affect ?', '', '2024-10-23', '1970-01-01', '1970-01-01', 'de 9h à 12h30', 'Caen', 6, 185, 0, 3, 1, 1),
('Savoir qualifier un problème d’argent', '', 'Variation de trésorerie ou bien cashburn ? Votre situation de trésorerie ne cesse de fluctuer et vous continuez à naviguer à l’aveugle. Un après-midi pour véritablement comprendre mes flux de trésorerie, découvrir les outils de financement, reprendre la main sur mon compte bancaire. Et toi, combien coute ton argent ?', 'Le plus : Présence d’un expert en finances d’entreprises', '2024-11-15', '1970-01-01', '1970-01-01', 'de 9h à 12h30', 'Caen', 6, 295, 0, 3, 1, 17),
('Digitaliser et adapter sa conquête commerciale', '', 'Au travers d’un atelier 100% pratique d’une demi-journée, une réflexion-adaptation de ses méthodes de conquête au regard des nouvelles réalités imposées par le digital', 'Le plus : Présence d’un expert en référencement pour des analyses en direct de votre efficacité', '2024-11-19', '1970-01-01', '1970-01-01', 'de 9h à 12h30', 'Caen', 6, 295, 0, 3, 1, 1),
('Faire de la médiation un outil managérial', '', 'Litige, procès, vous craignez les difficultés avec vos partenaires, vos salariés ?\r\nCette préoccupation vous mine. Elle freine votre activité professionnelle, votre déploiement commercial. Des solutions, des réponses efficaces et faciles à mettre en œuvre existent. Découvrons les ensemble', 'Le plus : Présence d’un médiateur qui nous partagera son expertise', '2024-12-02', '1970-01-01', '1970-01-01', 'de 9h à 12h30', 'Caen', 6, 295, 0, 3, 1, 17),
('“Quoi ma gueule ?”', 'Personal branding', 'A l’heure du numérique, injonction nous est faite de nous montrer, de devenir un « personnage public » sur les réseaux sociaux. Pas simple pour beaucoup, douloureux et insupportable pour la majorité. Et si cette injonction était un nouveau levier de performance ?', '', '2024-11-07', '1970-01-01', '1970-01-01', 'de 18h30 à 20h', 'Caen', 0, 115, 0, 6, 3, 2),
('“J’aime pas les jeunes qui aiment pas les vieux”', 'Marque employeur', 'Nombre sont celles et ceux qui pensent irréconciliables les générations : on ne se comprend pas, on ne se respecte pas. Et pourtant si le management intergénérationnel était une formidable opportunité ?', '', '2024-11-27', '1970-01-01', '1970-01-01', 'de 18h30 à 20h', 'Caen', 0, 115, 0, 6, 3, 2);


INSERT INTO 'host' ('name_host') VALUES
('François PINEDA'),
('non précisé'),
( 'Thierry PERRETTE');


INSERT INTO 'sub_category' ('name_subcat') VALUES
('afterwork'),
('les ateliers'),
('cursus 5 jours'),
('cursus 3 jours'),
('conférences'),
( 'workflow');

INSERT INTO video (link) VALUES
('https://www.youtube.com/embed/62PdsOYKVpQ?si=qfdja0QJ-x87Q5nt'),
('https://www.youtube.com/embed/vayDIshiVGQ?si=6m3zAnN9oZKnRc6h'),
('https://www.youtube.com/embed/m7qlSGhSLq8?si=xBfh_jqNoy4f6sp2'),
('https://www.youtube.com/embed/HapqtBbO_Rg?si=F04Q7tk8v1i9MuV7'),
('https://www.youtube.com/embed/GNMCwuzduO8?controls=1&amp;rel=0&amp;playsinline=0&amp;modestbranding=1&amp;autoplay=0&amp;enablejsapi=1&amp;origin=https%3A%2F%2Fboss2boss.club&amp;widgetid=1');


INSERT INTO `status`(`state_value`) VALUES ('0');

INSERT INTO `status`(`state_value`) VALUES ('1');