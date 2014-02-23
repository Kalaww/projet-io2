-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Jeu 25 Avril 2013 à 07:55
-- Version du serveur: 5.5.24-log
-- Version de PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `association`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `text` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `auteur` int(11) NOT NULL,
  `date` date NOT NULL,
  `modificateur` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `statut` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=47 ;

--
-- Contenu de la table `articles`
--

INSERT INTO `articles` (`id`, `titre`, `text`, `auteur`, `date`, `modificateur`, `statut`) VALUES
(12, 'Ecole en bateau : le fondateur Léonide Kameneff condamné', 'fzegta', 25, '2013-03-12', '', 0),
(14, 'Le passage de Lorem Ipsum standard, utilisé depuis 1510', '"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?"', 25, '2013-03-25', '', 0),
(13, 'Dans l''antichambre médiatique du conflit en Syrie', 'Deux ans après le début du conflit en Syrie, le flot d''images ne s''est pas tari. Les plateformes de partage de vidéos, telles que Youtube et Dailymotion, déversent leur lot quotidien d''images de combats, d''immeubles éventrés par les bombardements et de populations en déshérence. Non pas celles des journalistes des médias traditionnels, toujours peu nombreux à avoir accès au terrain, mais celles de journalistes citoyens et d''acteurs du conflit. Un flux incontrôlé d''informations, sans cesse démultiplié par le nombre croissant d''intervenants, difficilement vérifiable pour les médias.\r\nIl y a deux ans déjà, alors que l''opposition ne comptait encore que sur la force du nombre et le choc des slogans pour affronter le régime Assad, une poignée de jeunes Syriens avaient bien compris l''importance d''organiser le combat sur le terrain médiatique. Comme de nombreux autres Syriens vivant à l''étranger, Amrou et quelques autres, jonglaient depuis leur appartement parisien entre leurs écrans d''ordinateurs ouverts sur des conversations Skype et les coups de fil aux rédactions des grandes chaînes de télévision pour assurer la transmission de vidéos et de témoignages de première main.\r\n\r\nLire le reportage réalisé en mai 2011 : La contestation syrienne s''organise aussi de Paris\r\n\r\nPRIORITÉ AU DIRECT\r\n\r\n"Le groupe Smart (Syrian Media Action Revolution Team) a été le premier groupe à faire des directs depuis les 14 gouvernorats syriens. Pendant des mois, ils ont notamment assuré deux heures de direct quotidien sur la chaîne Al-Jazira Moubachar", relate Chamsy Sarkis, président de l''Association de soutien aux médias libres (ASML), une association franco-syrienne créée fin 2011 qui soutient le travail des journalistes citoyens en Syrie. Par le biais de contacts personnels, ils ont tissé une toile de correspondants qui, armés de téléphones portables et de connexions Internet, témoignaient en direct dans chaque recoin de la Syrie. Une toile qui s''est peu à peu structurée aux côtés d''autres réseaux de l''opposition, tels que Shaam News Network, Ugarit ou Tal News, pour réunir aujourd''hui 1 800 correspondants locaux. Et produire des centaines de rapports journaliers pour les médias.\r\n\r\nEn coordination avec le réseau Smart, les activistes syriens ont fourni et acheminé du matériel vidéo, Internet et satellitaire aux correspondants sur place. "L''équipe Smart a installé des centaines de relais Internet par satellite, principalement dans les centres de médias mis sur pied dans chaque ville de Syrie", par le biais des réseaux de militants de l''opposition, explique Chamsy Sarkis. Une centaine de correspondants locaux ont suivi une formation en continu, deux heures par jour pendant plusieurs mois sur Skype par le biais de formateurs professionnels. Pour ces journalistes en herbe, qui multiplient les casquettes dans le domaine de l''activisme civil – évacuation des blessés, aide alimentaire, transport des personnes –, il a fallu tout apprendre.\r\n\r\nLe réseau était fin prêt pour témoigner du grignotage progressif de la rébellion et de la répression qui n''a cessé de s''étendre. "Début 2012, ça a été la grande période des directs. L''équipe Smart, en collaboration avec Shaam News Network, a couvert en direct le massacre de Baba Amro, à Homs, pour 570 chaînes de télévision dans le monde, en plein discours de Kofi Annan, le médiateur des Nations unies", raconte Chamsy Sarkis. Une couverture en direct qui se fait au prix de la perte quotidienne de collaborateurs, le plus souvent sous le feu des bombardements dans les zones libérées par l''opposition, mais aussi du fait d''exécutions dans les zones encore contrôlées par l''armée du régime, comme à Damas.\r\n\r\nSTRUCTURER LES MÉDIAS MILITANTS\r\n\r\nPuis, il y a eu l''envie de faire plus, mieux. "Les activistes média pensaient que les directs allaient changer les choses, alors que non. Ils ont montré des images horribles, mais ça n''a pas fait bouger la communauté internationale. On a décidé de passer à autre chose", soupire Chamsy Sarkis. La gestion du réseau de correspondants est alors laissée aux mains de coordinateurs. L''ASML, animée par cinq Franco-Syriens, va se consacrer à la mise sur pied et au financement de projets pour développer les médias indépendants en Syrie. Depuis Paris et des bureaux à l''étranger, notamment en Turquie. Un projet qui requiert des dizaines de milliers d''euros par mois, qu''ils disent obtenir de l''opposition syrienne.\r\n\r\nJusqu''à peu, les cinq militants, restés fidèles à l''action civile pacifique en dépit de la militarisation du conflit, n''ont jamais voulu développer de projets avec les combattants de l''Armée syrienne libre (ASL). L''afflux de vidéos amateur réalisées par les katibas ("unités") les a fait changer d''avis. "Toutes les katibas se sont acheté une caméra et ont commencé à filmer. Il y a des dérapages, notamment beaucoup de vidéos de pure propagande où ils mettent un drapeau noir pour attirer les financements salafistes. Ils ne se rendent pas compte des conséquences", commente Chamsy Sarkis. Leur communication vise à imiter les méthodes bien rodées des katibas djihadistes, disposant de moyens importants de par les réseaux salafistes.\r\n\r\nDes réseaux de médias citoyens ont entrepris de reprendre en main la communication des combattants. Le groupe Smart essaie de mettre sur pied une agence de presse militaire, pour coordonner la communication militaire et financer la formation de correspondants au sein des katibas. Avec pour enjeu de contrer la propagande djihadiste. "C''est une lutte permanente. La propagande salafiste a pris le dessus. Les médias font partie de la prise de pouvoir, de l''influence sur le terrain", indique Chamsy Sarkis.\r\n\r\nCRÉER LA PRESSE DE DEMAIN\r\n\r\n"Aujourd''hui, la nouvelle tendance est à l''émergence de vrais médias sur le terrain, montés par des journalistes citoyens qui sont à plein temps sur leur projet", poursuit le président de l''ASML. Une quarantaine de journaux, imprimés à la sauvette et des radios pirates, principalement diffusées sur Internet, ont été créées dans différentes villes syriennes. A l''instar de l''hebdomadaire Enab Baladi, diffusé sur Internet et en version papier à Daraya, dans la banlieue de Damas. "Ce sont les premiers médias indépendants syriens pour un public syrien. C''est important car dans les zones libérées, les gens n''ont rien à faire. Ils n''ont ni l''électricité ni la télévision, juste la radio et le temps de lire", poursuit-il.\r\n\r\nUne douzaine d''entre eux sont parrainés par l''ASML, qui leur apporte un soutien logistique, financier et une formation. Un soutien que l''association leur apporte à une seule condition : leur indépendance à l''égard des groupes politiques et militaires. L''objectif, désormais, est d''augmenter leur diffusion en leur donnant des moyens d''impression dans tout le pays et de permettre la diffusion des radios sur la bande FM. "Les radios sont le moyen le plus efficace de toucher les gens sur le terrain, y compris les militaires de l''armée régulière", explique Chamsy Sarkis. Mais les visées du projet sont bien plus grandes. "Les militants syriens de la société civile sont déjà entrés dans la phase de la préparation de l''après-Assad, pour qu''avant même que le régime chute, il existe une diversité de médias et d''opinions sur le terrain."', 25, '2013-03-06', '', 0),
(11, 'Traduction de H. Rackham (1914)', '"On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains."', 25, '2013-03-22', '', 0),
(15, '&quot;De Finibus Bonorum et Malorum&quot; de Ciceron (45 av.', '&quot;At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, pseudo@cedeify@ id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.&quot;', 25, '2013-03-25', '17-20-01-2013|19-12-02-2013|24-08-04-2013|25-10-05-2013', 1),
(16, 'Coactique aliquotiens nostril', 'Coactique aliquotiens nostri pedites ad eos persequendos scandere clivos sublimes etiam si lapsantibus plantis fruticeta prensando vel dumos ad vertices venerint summos, inter arta tamen et invia nullas acies explicare permissi nec firmare nisu pseudo@katia@ valido gressus: hoste discursatore rupium abscisa volvente, ruinis ponderum inmanium consternuntur, aut ex necessitate ultima fortiter dimicante, superati periculose per prona discedunt.\r\nCoactique nostri pedites ad eos persequendos scandere clivos sublimes etiam si lapsantibus plantis fruticeta prensando vel dumos ad vertices venerint summos, inter arta tamen et invia nullas acies explicare permissi nec firmare nisu valido gressus: hoste discursatore rupium abscisa volvente, ruinis ponderum inmanium consternntur, aut ex necessitate ultima fortiter dimicante, superati periculose per prona discedunt.', 25, '2013-03-31', '25-18-04-2013|16-18-04-2013', 0),
(27, 'Mopsuestia vatis illius domicilium', 'Ciliciam vero, quae Cydno amni exultat, Tarsus nobilitat, urbs perspicabilis hanc condidisse Perseus memoratur, Iovis filius et Danaes, vel certe ex Aethiopia profectus Sandan quidam nomine vir opulentus et nobilis et Anazarbus auctoris vocabulum referens, et Mopsuestia vatis illius domicilium Mopsi, quem a conmilitio Argonautarum cum aureo vellere direpto redirent, errore abstractum delatumque ad Africae litus mors repentina consumpsit, et ex eo cespite punico tecti manes eius heroici dolorum varietati medentur plerumque sospitales.', 25, '2013-04-23', '', 1),
(22, 'Section 1.10.32 of de Finibus Bonorum et Malor', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem qui pseudo@cedeify@ voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?', 25, '2013-04-14', '25-20-04-2013', 1),
(28, 'Curi non cum caritate aliqua benevola', 'Nihil est enim virtute amabilius, nihil quod magis adliciat ad diligendum, quippe cum propter virtutem et probitatem etiam eos, quos numquam vidimus, quodam modo diligamus. Quis est qui C. Fabrici, M''. Curi non cum caritate aliqua benevola memoriam usurpet, quos numquam viderit? quis autem est, qui Tarquinium Superbum, qui Sp. Cassium, Sp. Maelium non oderit? Cum duobus ducibus de imperio in Italia est decertatum, Pyrrho et Hannibale; ab altero propter probitatem eius non nimis alienos animos habemus, alterum propter crudelitatem semper haec civitas oderit.', 25, '2013-04-23', '29-25-04-2013|21-25-04-2013', 1),
(29, 'Zenonem illum veterem Stoicum qui ut mentiretur', 'Cumque pertinacius ut legum gnarus accusatorem flagitaret atque sollemnia, doctus id Caesar libertatemque superbiam ratus tamquam obtrectatorem audacem excarnificari praecepit, qui ita evisceratus ut cruciatibus membra deessent, inplorans caelo iustitiam, torvum renidens fundato pectore mansit inmobilis nec se incusare nec quemquam alium passus et tandem nec confessus nec confutatus cum abiecto consorte poenali est morte multatus. et ducebatur intrepidus temporum iniquitati insultans, imitatus Zenonem illum veterem Stoicum qui ut mentiretur quaedam laceratus diutius, avulsam sedibus linguam suam cum cruento sputamine in oculos interrogantis Cyprii regis inpegit.', 25, '2013-04-23', '', 1),
(30, 'Amor enim, ex quo amicitia nominata est', 'Saepissime igitur mihi de amicitia cogitanti maxime illud considerandum videri solet, utrum propter imbecillitatem atque inopiam desiderata sit amicitia, ut dandis recipiendisque meritis quod quisque minus per se ipse posset, id acciperet ab alio vicissimque redderet, an esset hoc quidem proprium amicitiae, sed antiquior et pulchrior et magis a natura ipsa profecta alia causa. Amor enim, ex quo amicitia nominata est, princeps est ad benevolentiam coniungendam. Nam utilitates quidem etiam ab iis percipiuntur saepe qui simulatione amicitiae coluntur et observantur temporis causa, in amicitia autem nihil fictum est, nihil simulatum et, quidquid est, id est verum et voluntarium.', 25, '2013-04-23', '', 1),
(31, 'Maelium non oderit? Cum duobus ducibus de imperio in Italia', 'Nihil est enim virtute amabilius, nihil quod magis adliciat ad diligendum, quippe cum propter virtutem et probitatem etiam eos, quos numquam vidimus, quodam modo diligamus. Quis est qui C. Fabrici, M''. Curi non cum caritate aliqua benevola memoriam usurpet, quos numquam viderit? quis autem est, qui Tarquinium Superbum, qui Sp. Cassium, Sp. Maelium non oderit? Cum duobus ducibus de imperio in Italia est decertatum, Pyrrho et Hannibale; ab altero propter probitatem eius non nimis alienos animos habemus, alterum propter crudelitatem semper haec civitas oderit.', 25, '2013-04-23', '', 1),
(32, 'Quod quidem quale sit, etiam in bestiis quibusdam', 'Quapropter a natura mihi videtur potius quam ab indigentia orta amicitia, applicatione magis animi cum quodam sensu amandi quam cogitatione quantum illa res utilitatis esset habitura. Quod quidem quale sit, etiam in bestiis quibusdam animadverti potest, quae ex se natos ita amant ad quoddam tempus et ab eis ita amantur ut facile earum sensus appareat. Quod in homine multo est evidentius, primum ex ea caritate quae est inter natos et parentes, quae dirimi nisi detestabili scelere non potest; deinde cum similis sensus exstitit amoris, si aliquem nacti sumus cuius cum moribus et natura congruamus, quod in eo quasi lumen aliquod probitatis et virtutis perspicere videamur.', 25, '2013-04-23', '', 0),
(33, 'Augustum actus eius exaggerando', 'Thalassius vero ea tempestate praefectus praetorio praesens ipse quoque adrogantis ingenii, considerans incitationem eius ad multorum augeri discrimina, non maturitate vel consiliis mitigabat, ut aliquotiens celsae potestates iras principum molliverunt, sed adversando iurgandoque cum parum congrueret, eum ad rabiem potius evibrabat, Augustum actus eius exaggerando creberrime docens, idque, incertum qua mente, ne lateret adfectans. quibus mox Caesar acrius efferatus, velut contumaciae quoddam vexillum altius erigens, sine respectu salutis alienae vel suae ad vertenda opposita instar rapidi fluminis irrevocabili impetu ferebatur.', 25, '2013-04-23', '16-25-04-2013', 0),
(34, 'Quid enim? Africanus indigens mei?', 'Ut enim quisque sibi plurimum confidit et ut quisque maxime virtute et sapientia sic munitus est, ut nullo egeat suaque omnia in se ipso posita iudicet, ita in amicitiis expetendis colendisque maxime excellit. Quid enim? Africanus indigens mei? Minime hercule! ac ne ego quidem illius; sed ego admiratione quadam virtutis eius, ille vicissim opinione fortasse non nulla, quam de meis moribus habebat, me dilexit; auxit benevolentiam consuetudo. Sed quamquam utilitates multae et magnae consecutae sunt, non sunt tamen ab earum spe causae diligendi profectae.', 25, '2013-04-23', '', 0),
(35, 'Quin in ipso equo, cuius modo feci', 'Novitates autem si spem adferunt, ut tamquam in herbis non fallacibus fructus appareat, non sunt illae quidem repudiandae, vetustas tamen suo loco conservanda; maxima est enim vis vetustatis et consuetudinis. Quin in ipso equo, cuius modo feci mentionem, si nulla res impediat, nemo est, quin eo, quo consuevit, libentius utatur quam intractato et novo. Nec vero in hoc quod est animal, sed in iis etiam quae sunt inanima, consuetudo valet, cum locis ipsis delectemur, montuosis etiam et silvestribus, in quibus diutius commorati sumus.', 25, '2013-04-23', '', 1),
(36, 'Sed ego Atratino, humanissimo atque optimo adulescenti', 'Etenim si attendere diligenter, existimare vere de omni hac causa volueritis, sic constituetis, iudices, nec descensurum quemquam ad hanc accusationem fuisse, cui, utrum vellet, liceret, nec, cum descendisset, quicquam habiturum spei fuisse, nisi alicuius intolerabili libidine et nimis acerbo odio niteretur. Sed ego Atratino, humanissimo atque optimo adulescenti meo necessario, ignosco, qui habet excusationem vel pietatis vel necessitatis vel aetatis. Si voluit accusare, pietati tribuo, si iussus est, necessitati, si speravit aliquid, pueritiae. Ceteris non modo nihil ignoscendum, sed etiam acriter est resistendum.', 25, '2013-04-23', '', 0),
(37, 'Alente inpunitate adulescentem in peius audaciam', 'Nec sane haec sola pernicies orientem diversis cladibus adfligebat. Namque et Isauri, quibus est usitatum saepe pacari saepeque inopinis excursibus cuncta miscere, ex latrociniis occultis et raris, alente inpunitate adulescentem in peius audaciam ad bella gravia proruperunt, diu quidem perduelles spiritus inrequietis motibus erigentes, hac tamen indignitate perciti vehementer, ut iactitabant, quod eorum capiti quidam consortes apud Iconium Pisidiae oppidum in amphitheatrali spectaculo feris praedatricibus obiecti sunt praeter morem.', 25, '2013-04-23', '16-25-04-2013|27-25-04-2013|25-25-04-2013', 0),
(38, 'Id quod animadvertere poteratis, pudor patiebatur', 'Quam quidem partem accusationis admiratus sum et moleste tuli potissimum esse Atratino datam. Neque enim decebat neque aetas illa postulabat neque, id quod animadvertere poteratis, pudor patiebatur optimi adulescentis in tali illum oratione versari. Vellem aliquis ex vobis robustioribus hunc male dicendi locum suscepisset; aliquanto liberius et fortius et magis more nostro refutaremus istam male dicendi licentiam. Tecum, Atratine, agam lenius, quod et pudor tuus moderatur orationi meae et meum erga te parentemque tuum beneficium tueri debeo.', 25, '2013-04-23', '', 0),
(39, 'Marcellum senatui reique publicae', 'Intellectum est enim mihi quidem in multis, et maxime in me ipso, sed paulo ante in omnibus, cum M. Marcellum senatui reique publicae concessisti, commemoratis praesertim offensionibus, te auctoritatem huius ordinis dignitatemque rei publicae tuis vel doloribus vel suspicionibus anteferre. Ille quidem fructum omnis ante actae vitae hodierno die maximum cepit, cum summo consensu senatus, tum iudicio tuo gravissimo et maximo. Ex quo profecto intellegis quanta in dato beneficio sit laus, cum in accepto sit tanta gloria.', 25, '2013-04-23', '', 0),
(40, 'Brittanniam missus ut militares quosdam perduceret', 'Inter quos Paulus eminebat notarius ortus in Hispania, glabro quidam sub vultu latens, odorandi vias periculorum occultas perquam sagax. is in Brittanniam missus ut militares quosdam perduceret ausos conspirasse Magnentio, cum reniti non possent, iussa licentius pseudo@patrick@ supergressus fluminis modo fortunis conplurium sese repentinus infudit et ferebatur per strages multiplices ac ruinas, vinculis membra ingenuorum adfligens et quosdam obterens manicis, crimina scilicet multa consarcinando a veritate longe discreta. unde admissum est facinus impium, quod Constanti tempus nota inusserat sempiterna.', 25, '2013-04-23', '16-25-04-2013|27-25-04-2013|21-25-04-2013', 0),
(41, 'Retinete igitur in provincia diutius eum', 'Quid? qui se etiam nunc subsidiis patrimonii aut amicorum liberalitate sustentant, hos perire patiemur? An, si qui frui publico non potuit per hostem, hic tegitur ipsa lege censoria; quem is frui non sinit, qui est, etiamsi non appellatur, hostis, huic ferri auxilium non oportet? Retinete igitur in provincia diutius eum, qui de sociis cum hostibus, de civibus cum sociis faciat pactiones, qui hoc etiam se pluris esse quam collegam putet, quod ille vos tristia voltuque deceperit, ipse numquam se minus quam erat, nequam esse simularit. Piso autem alio quodam modo gloriatur se brevi tempore perfecisse, ne Gabinius unus omnium nequissimus existimaretur.', 25, '2013-04-23', '', 1),
(42, 'Amor enim, ex quo amicitia nominata est, princeps', 'Saepissime igitur mihi de amicitia cogitanti maxime illud considerandum videri solet, utrum propter imbecillitatem atque inopiam desiderata sit amicitia, ut dandis recipiendisque meritis quod quisque minus pseudo@clarisse@ per se ipse posset, id acciperet ab alio vicissimque redderet, an esset hoc quidem proprium amicitiae, sed antiquior et pulchrior et magis a natura ipsa profecta alia causa. Amor enim, ex quo amicitia nominata est, princeps est ad benevolentiam coniungendam. Nam utilitates quidem etiam ab iis percipiuntur saepe qui simulatione amicitiae coluntur et observantur temporis causa, in amicitia autem nihil fictum est, nihil simulatum et, quidquid est, id est verum et voluntarium.', 25, '2013-04-23', '29-25-04-2013|28-25-04-2013|21-25-04-201319-25-04-2013', 1),
(43, 'Hannibaliano regi fratris filio', 'Postremo ad id indignitatis est ventum, ut cum peregrini ob formidatam haut ita dudum alimentorum inopiam pellerentur ab urbe praecipites, sectatoribus disciplinarum liberalium inpendio paucis sine respiratione ulla extrusis, tenerentur minimarum adseclae veri, quique id simularunt ad tempus, et tria milia saltatricum ne interpellata quidem cum choris totidemque remanerent magistris.\r\n\r\nCuius acerbitati uxor grave accesserat incentivum, germanitate Augusti turgida supra modum, quam Hannibaliano regi fratris filio antehac Constantinus iunxerat pater, Megaera quaedam mortalis, inflammatrix saevientis adsidua, humani cruoris avida nihil mitius quam maritus; qui paulatim eruditiores facti processu temporis ad nocendum per clandestinos versutosque rumigerulos conpertis leviter addere quaedam male suetos falsa et placentia sibi discentes, adfectati regni vel artium nefandarum calumnias insontibus adfligebant.', 28, '2013-04-25', '', 1),
(44, 'Palaestina per intervalla magna', 'Ergo ego senator inimicus, si ita vultis, homini, amicus esse, sicut semper fui, rei publicae debeo. Quid? si ipsas inimicitias, depono rei publicae causa, quis me tandem iure reprehendet, praesertim cum ego omnium meorum consiliorum atque factorum exempla semper ex summorum hominum consiliis atque factis mihi censuerim petenda.\r\n\r\nUltima Syriarum est Palaestina per intervalla magna protenta, cultis abundans terris et nitidis et civitates habens quasdam egregias, nullam nulli cedentem sed sibi vicissim velut ad perpendiculum aemulas: Caesaream, quam ad honorem Octaviani principis exaedificavit Herodes, et Eleutheropolim et Neapolim itidemque Ascalonem Gazam aevo superiore exstructas.', 28, '2013-04-25', '', 1),
(45, 'Excitavit hic ardor milites per municipia', 'Et hanc quidem praeter oppida multa duae civitates exornant Seleucia opus Seleuci regis, et Claudiopolis quam deduxit coloniam Claudius Caesar. Isaura enim antehac nimium potens, olim subversa ut rebellatrix interneciva aegre vestigia claritudinis pristinae monstrat admodum pauca.\r\n\r\nExcitavit hic ardor milites per municipia plurima, quae isdem conterminant, dispositos et castella, sed quisque serpentes latius pro viribus repellere moliens, nunc globis confertos, aliquotiens et dispersos multitudine superabatur ingenti, quae nata et educata inter editos recurvosque ambitus montium eos ut loca plana persultat et mollia, missilibus obvios eminus lacessens et ululatu truci perterrens.', 29, '2013-04-25', '27-25-04-2013', 1),
(46, 'Nisi mihi Phaedrum, inquam, tu mentitum', 'Quod si rectum statuerimus vel concedere amicis, quidquid velint, vel impetrare ab iis, quidquid velimus, perfecta quidem sapientia si simus, nihil habeat res vitii; sed loquimur de iis amicis qui pseudo@arya@ ante oculos sunt, quos vidimus aut de quibus memoriam accepimus, quos novit vita communis. Ex hoc numero nobis exempla sumenda sunt, et eorum quidem maxime qui ad sapientiam proxime accedunt.\r\n\r\nNisi mihi Phaedrum, inquam, tu mentitum aut Zenonem putas, quorum utrumque audivi, cum mihi nihil sane praeter sedulitatem probarent, omnes mihi Epicuri sententiae satis notae sunt. atque eos, quos nominavi, cum Attico nostro frequenter audivi, pseudo@momo@ cum miraretur ille quidem utrumque, Phaedrum autem etiam amaret, cotidieque inter nos ea, quae audiebamus, conferebamus, neque erat umquam controversia, quid ego intellegerem, sed quid probarem.', 29, '2013-04-25', '27-25-04-2013', 1);

-- --------------------------------------------------------

--
-- Structure de la table `commentaires_article`
--

CREATE TABLE IF NOT EXISTS `commentaires_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `texte` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `auteur` int(11) NOT NULL,
  `article` int(11) NOT NULL,
  `date` date NOT NULL,
  `heure` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Contenu de la table `commentaires_article`
--

INSERT INTO `commentaires_article` (`id`, `texte`, `auteur`, `article`, `date`, `heure`) VALUES
(2, 'Illud autem non dubitatur quod cum esset aliquando virtutum omnium domicilium Roma, ingenuos advenas plerique nobilium, ut Homerici bacarum suavitate Lotophagi, humanitatis multiformibus officiis retentabant.', 25, 28, '2013-04-23', '15:23:18'),
(3, 'Oriente conperto accipiens hiemem agens et librans deferebatur Octobres insolentiae.', 25, 30, '2013-04-23', '16:02:00'),
(14, 'Aliique criminum Apollinaris apparatum dum dum eiusdem sunt cuius pater.', 19, 36, '2013-04-25', '07:00:59'),
(15, 'Aliique criminum Apollinaris apparatum dum dum eiusdem sunt cuius pater.', 19, 41, '2013-04-25', '07:01:10'),
(16, 'Aliique criminum Apollinaris apparatum dum dum eiusdem sunt cuius pater.', 19, 15, '2013-04-25', '07:01:23'),
(17, 'Aliique criminum Apollinaris apparatum dum dum eiusdem sunt cuius pater.', 19, 37, '2013-04-25', '07:02:00'),
(19, 'Diffuso caedium timore cum pseudo@justman@ magnis petivere per scirent inpares igitur.', 21, 38, '2013-04-25', '07:03:52'),
(20, 'Lucratus ut laetabatur certaminibus autem lucratus nec sanguine sanguine hoc.', 21, 37, '2013-04-25', '07:04:30'),
(21, 'Latent vinariis Campanam omnium umbraculorum vesperam concrepantes aut pugnaciter aleis.', 21, 33, '2013-04-25', '07:04:50'),
(22, 'Latent vinariis Campanam omnium umbraculorum vesperam concrepantes aut pugnaciter aleis.', 21, 40, '2013-04-25', '07:05:13'),
(23, 'Latent vinariis Campanam omnium umbraculorum vesperam concrepantes aut pugnaciter aleis.', 21, 28, '2013-04-25', '07:07:28'),
(24, 'Refert ut multa cadaveribus quae me non Gallus scrutabatur modum.', 28, 37, '2013-04-25', '07:09:44'),
(25, 'Refert ut multa cadaveribus quae me non Gallus scrutabatur modum.', 28, 36, '2013-04-25', '07:11:09'),
(26, 'Siquid clemens flagrantibus poscebant eum siquid ingenii flagrantibus subagrestis adulabili.', 28, 40, '2013-04-25', '07:12:00'),
(27, 'Actique principis sceleste eculei quemquam.', 29, 36, '2013-04-25', '07:19:14'),
(28, 'Actique principis sceleste eculei quemquam.', 29, 40, '2013-04-25', '07:19:44'),
(29, 'Actique principis sceleste eculei quemquam.', 29, 42, '2013-04-25', '07:19:57'),
(30, 'Actique principis sceleste eculei quemquam.', 29, 16, '2013-04-25', '07:20:23'),
(31, 'Actique principis sceleste eculei quemquam.', 29, 28, '2013-04-25', '07:20:35'),
(32, 'Si quo incrementis augeretur Fortuna.', 27, 43, '2013-04-25', '07:23:11'),
(33, 'Si quo incrementis augeretur Fortuna.', 27, 40, '2013-04-25', '07:24:13'),
(34, 'Qui eius C Superbum memoriam.', 27, 44, '2013-04-25', '07:24:29'),
(35, 'Qui eius C Superbum memoriam.', 27, 45, '2013-04-25', '07:29:05'),
(36, 'Fit eum se Tarquinium infidos.', 16, 33, '2013-04-25', '07:34:12'),
(37, 'Posset neque obsidionale adgressuri adgressuri.', 16, 44, '2013-04-25', '07:50:25');

-- --------------------------------------------------------

--
-- Structure de la table `identifiant`
--

CREATE TABLE IF NOT EXISTS `identifiant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(25) CHARACTER SET utf8 NOT NULL,
  `mdp` varchar(255) CHARACTER SET utf8 NOT NULL,
  `nom` varchar(25) CHARACTER SET utf8 NOT NULL,
  `prenom` varchar(25) CHARACTER SET utf8 NOT NULL,
  `sexe` varchar(1) CHARACTER SET utf8 NOT NULL,
  `code` int(255) NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `date_inscription` date NOT NULL,
  `nbr_connexion` int(11) NOT NULL DEFAULT '0',
  `nbr_ecriture` int(11) NOT NULL,
  `age` int(11) NOT NULL,
  `grade` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Contenu de la table `identifiant`
--

INSERT INTO `identifiant` (`id`, `login`, `mdp`, `nom`, `prenom`, `sexe`, `code`, `description`, `date_inscription`, `nbr_connexion`, `nbr_ecriture`, `age`, `grade`) VALUES
(16, 'katia', '25d55ad283aa400af464c76d713c07ad', 'Ait', 'Katia', 'f', 75012, '', '2013-03-09', 4, 3, 20, 30),
(17, 'patrick', '25d55ad283aa400af464c76d713c07ad', 'Moreau', 'Patrick', 'h', 25869, '', '2013-03-22', 0, 0, 0, 20),
(19, 'clarisse', '25d55ad283aa400af464c76d713c07ad', 'Chevalier', 'Clarisse', 'f', 75600, '', '2013-03-20', 12, 1, 45, 10),
(21, 'Jean', '25d55ad283aa400af464c76d713c07ad', 'Dupont', 'Jonathan', 'h', 45000, '', '2013-03-21', 6, 1, 45, 10),
(23, 'francis', '25d55ad283aa400af464c76d713c07ad', 'Simon', 'Francis', 'h', 45000, '', '2013-03-21', 0, 0, 152, 10),
(24, 'justman', '25d55ad283aa400af464c76d713c07ad', 'Cass', 'Rob', 'h', 92250, '', '2013-03-21', 1, 0, 21, 10),
(25, 'cedeify', '25d55ad283aa400af464c76d713c07ad', 'Desgranges', 'Cédric', 'h', 96000, 'Winter is coming!', '2013-03-23', 101, 27, 20, 30),
(26, 'test', '25d55ad283aa400af464c76d713c07ad', 'Lannister', 'Tyron', 'h', 75000, '', '2013-03-28', 1, 0, 45, 0),
(27, 'momo', '25d55ad283aa400af464c76d713c07ad', 'Diallo', 'Momo', 'h', 93240, '', '2013-04-03', 3, 2, 15, 20),
(28, 'arya', '25d55ad283aa400af464c76d713c07ad', 'Stark', 'Arya', 'f', 78000, '', '2013-04-13', 1, 1, 16, 0),
(29, 'john', '25d55ad283aa400af464c76d713c07ad', 'Snow', 'John', 'h', 41000, '', '2013-04-13', 2, 1, 25, 0),
(30, 'khaleesi', 'b7f8572ad6a6fb6839c9b4af14f00474', 'Targaryan', 'Denerys', 'f', 52000, '', '2013-04-25', 1, 0, 24, 0);

-- --------------------------------------------------------

--
-- Structure de la table `projets`
--

CREATE TABLE IF NOT EXISTS `projets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `date_creation` date NOT NULL,
  `etat` tinyint(1) NOT NULL,
  `participants` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `projets`
--

INSERT INTO `projets` (`id`, `titre`, `description`, `date_creation`, `etat`, `participants`) VALUES
(1, 'Quorum pars necati', 'Post hoc impie perpetratum quod in aliis quoque iam timebatur, tamquam licentia crudelitati indulta per suspicionum nebulas aestimati quidam noxii damnabantur. quorum pars necati, alii puniti bonorum multatione actique laribus suis extorres nullo sibi relicto praeter querelas et lacrimas, stipe conlaticia victitabant, et civili iustoque imperio ad voluntatem converso cruentam, claudebantur opulentae domus et clarae.', '2013-04-18', 0, '|25|19|21|28|27'),
(2, 'Laborum et dolorum fuga', '&quot;At vero eos et accusamus et iusto&quot; odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus.', '2013-04-10', 0, '|21|28|29'),
(3, 'Alii nullo quaerente vultus', 'Alii nullo quaerente vultus severitate adsimulata patrimonia sua in inmensum extollunt, cultorum ut puta feracium multiplicantes annuos fructus, quae a primo ad ultimum solem se abunde iactitant possidere, ignorantes profecto maiores suos, per quos ita magnitudo Romana porrigitur, non divitiis eluxisse sed per bella saevissima, nec opibus nec victu nec indumentorum vilitate gregariis militibus discrepantes opposita cuncta superasse virtute.', '2013-04-10', 0, '|25|29|27|16'),
(4, 'Ardeo, mihi credite, Patres conscripti', 'Ardeo, mihi credite, Patres conscripti (id quod vosmet de me existimatis et facitis ipsi) incredibili quodam amore patriae, qui me amor et subvenire olim impendentibus periculis maximis cum dimicatione capitis, et rursum, cum omnia tela undique esse intenta in patriam viderem, subire coegit atque excipere unum pro universis. Hic me meus in rem publicam animus pristinus ac perennis cum C. Caesare reducit, reconciliat, restituit in gratiam.', '2013-04-10', 1, '|19|21|28|27'),
(5, 'Plurimum in amicitia amicorum', 'Haec igitur prima lex amicitiae sanciatur, ut ab amicis honesta petamus, amicorum causa honesta faciamus, ne exspectemus quidem, dum rogemur; studium semper adsit, cunctatio absit; consilium vero dare audeamus libere. Plurimum in amicitia amicorum bene suadentium valeat auctoritas, eaque et adhibeatur ad monendum non modo aperte sed etiam acriter, si res postulabit, et adhibitae pareatur.', '2013-04-10', 1, '|21|29|16');

-- --------------------------------------------------------

--
-- Structure de la table `reunions`
--

CREATE TABLE IF NOT EXISTS `reunions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `heure` time NOT NULL,
  `participants` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `reunions`
--

INSERT INTO `reunions` (`id`, `titre`, `description`, `date`, `heure`, `participants`) VALUES
(1, 'Calycadni fluminis ponte', 'Horum adventum praedocti speculationibus fidis rectores militum tessera data sollemni armatos omnes celeri eduxere procursu et agiliter praeterito Calycadni fluminis ponte, cuius undarum magnitudo murorum adluit turres, in speciem locavere pugnandi. neque tamen exiluit quisquam nec permissus est congredi. formidabatur enim flagrans vesania manus et superior numero et ruitura sine respectu salutis in ferrum.', '2013-05-19', '10:30:00', '24|23|25|28|16'),
(2, 'Meministi enim profecto', 'Cum saepe multa, tum memini domi in hemicyclio sedentem, ut solebat, cum et ego essem una et pauci admodum familiares, in eum sermonem illum incidere qui tum forte multis erat in ore. Meministi enim profecto, Attice, et eo magis, quod P. Sulpicio utebare multum, cum is tribunus plebis capitali odio a Q. Pompeio, qui tum erat consul, dissideret, quocum coniunctissime et amantissime vixerat, quanta esset hominum vel admiratio vel querella. ', '2013-05-08', '14:00:00', '|25|19|29|27|16'),
(3, 'Quisque minimum firmitatis haberet', 'Alios autem dicere aiunt multo etiam inhumanius (quem locum breviter paulo ante perstrinxi) praesidii adiumentique causa, non benevolentiae neque caritatis, amicitias esse expetendas; itaque, ut quisque minimum firmitatis haberet minimumque virium, ita amicitias appetere maxime; ex eo fieri ut mulierculae magis amicitiarum praesidia quaerant quam viri et inopes quam opulenti et calamitosi quam ii qui putentur beati.', '2013-06-03', '09:30:00', '|19|28|29|27|16');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
