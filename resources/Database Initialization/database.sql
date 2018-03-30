DROP TABLE IF EXISTS Department;
DROP TABLE IF EXISTS Student;
DROP TABLE IF EXISTS Ta;
DROP TABLE IF EXISTS Tafor;
DROP TABLE IF EXISTS Applications;
DROP TABLE IF EXISTS Faculty;
DROP TABLE IF EXISTS Course;

CREATE TABLE Department(
    departmentName varchar(20) NOT NULL,
    registrationKey varchar(10) NOT NULL,
    PRIMARY KEY (departmentName)
);

CREATE TABLE Student(
    username varchar(50),
    psw varchar(50),
    studentId varchar(8),
    firstName varchar(50),
    middleName varchar(1),
    lastName varchar(50),
    email varchar(50),
    phone varchar(15),
    departmentName varchar(50),
    PRIMARY KEY (studentId)
);


CREATE TABLE TA_Experience(
    studentId varchar(8),
    courseCode varchar(10),
    academicYear varchar(4),
    section varchar(4),
    term enum('Fall', 'Spring', 'Winter', 'Summer'),
    PRIMARY KEY(studentId, courseCode, academicYear, section, term)
);

CREATE TABLE Applications(
    studentId varchar(8),
    academicYear varchar(4),
    course varchar(8),
    section varchar(4),
    term enum('Fall', 'Spring', 'Winter', 'Summer'),
    appStatus enum('New','Accepted', "Denied"),
    PRIMARY KEY (studentId, academicYear, course, section)
);

CREATE TABLE Faculty(
    username varchar(50) ,
    psw varchar(50),
    facultyId varchar(8),
    firstName varchar(50),
    middleName varchar(1),
    lastName varchar(50),
    email varchar(50),
    phone varchar(15),
    departmentName varchar(50),
    PRIMARY KEY (facultyId)
);

CREATE TABLE Course(
    courseName varchar(50),
    courseCode varchar(8),
    academicYear varchar(4),
    section varchar(4),
    term enum('Fall', 'Spring', 'Winter', 'Summer'),
    professorId varchar(8),
    PRIMARY KEY (courseCode, academicYear, sectionm term)
);

/*Insert Department*/
INSERT INTO Department VALUES("Computer Science", "CMSC1234");
INSERT INTO Department VALUES("Engineering", "ENEL1234");
INSERT INTO Department VALUES("Biology", "BIOL1234");

/*Insert Students*/
/* Computer Science */
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("NHS70ZLL6LE","9421",37864803,"Clayton","Danielle","Graves","quis.diam@ultrices.org","445-197-0023","Computer Science");
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("EBS32FLE3SS","6974",25967976,"Griffin","Axel","Ingram","quis.lectus@risusa.com","274-773-1061","Computer Science");
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("IYN13UDJ6ZF","9520",41520259,"Colby","Kylan","Sexton","non.luctus.sit@loremeu.edu","174-697-6233","Computer Science");
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("SIV31CDI2XI","8727",12955460,"Dahlia","Adrienne","Bradford","sit.amet.luctus@ac.net","234-746-8138","Computer Science");
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("HKG11EHZ9DE","5964",62849227,"Kalia","Summer","Giles","velit.justo@enimconsequatpurus.net","297-926-6857","Computer Science");
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("EKB09AIT3NB","9555",86096128,"Alexis","Connor","Combs","leo@magna.net","801-611-9802","Computer Science");
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("ISH46QYB5RS","7889",98060162,"Harper","Aurelia","Jones","ornare.facilisis.eget@interdumfeugiat.com","916-293-7861","Computer Science");
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("BHT64VKT0UF","2418",13365510,"Zachary","Miranda","Shepherd","lorem@egestasrhoncus.ca","983-138-0077","Computer Science");
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("KZW42OGY5VD","7121",90000603,"Leigh","Whoopi","Marsh","amet.ornare.lectus@ligulaconsectetuerrhoncus.net","213-701-7732","Computer Science");
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("HDH32EKM0LJ","6670",14638291,"Lee","Iliana","Maldonado","vulputate.risus@ipsumleoelementum.com","135-236-9626","Computer Science");
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("APW92VWX9BW","3167",23413560,"Austin","Erich","Randall","quam@imperdietdictummagna.com","681-968-9020","Computer Science");
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("WZK83PMZ3IY","4403",45211455,"Hakeem","Bradley","Ramos","montes.nascetur@Quisquenonummyipsum.org","127-888-7473","Computer Science");
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("KFA61SIN9RE","7754",73729147,"Oscar","Kylie","Savage","enim.Etiam.gravida@primisin.org","621-538-0886","Computer Science");
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("NCS31MNP8CP","6692",57380040,"Mariko","Urielle","Thomas","dolor@Nullamvelitdui.ca","554-644-7485","Computer Science");
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("LQH19LEY1RK","2986",65069438,"Hedy","Florence","Mclean","aliquam.arcu@enimSuspendisse.co.uk","621-453-0329","Computer Science");
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("RKH79UMG2LB","8902",85140330,"Denton","Fuller","Faulkner","dolor.elit@necligulaconsectetuer.com","709-636-1279","Computer Science");
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("GAA03AET1JA","8605",87868809,"Nell","Cameron","Mclaughlin","mollis@Morbivehicula.com","859-909-4884","Computer Science");
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("IEZ89JYF8YL","2416",55745952,"Quintessa","Dalton","Mathews","erat.nonummy@lectus.ca","397-131-5599","Computer Science");
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("UCS41RDU8YP","8532",64779844,"Jarrod","Kadeem","Atkins","sodales@mienimcondimentum.org","890-620-4269","Computer Science");
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("WUP54NCY0QK","5266",16701258,"Jamal","Priscilla","Ray","velit.in.aliquet@porttitor.org","494-105-8605","Computer Science");
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("XLX67HHN1ME","3756",23990326,"Chadwick","Maggie","Lester","id.risus.quis@Suspendissesed.co.uk","398-725-1610","Computer Science");
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("GVE56COM3NT","8563",21634892,"Leonard","Aaron","Lott","purus@tinciduntadipiscing.ca","366-726-5362","Computer Science");
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("CMT17ZTK2CD","8785",19178539,"Aladdin","Kieran","Parrish","nonummy.ac.feugiat@at.org","417-901-0461","Computer Science");
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("ISY59NIA5YE","3133",43529995,"Zorita","Stephanie","Bowman","Cras.sed@eunequepellentesque.org","980-563-5330","Computer Science");
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("OEF52KJD8DB","7194",77755316,"Lenore","Oren","Wilkinson","amet.massa.Quisque@idmagna.com","719-616-5813","Computer Science");
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("ADK89HYE9ZH","1287",43682965,"Clio","Griffin","Dillon","mauris@aliquetPhasellus.net","289-819-8136","Computer Science");
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("LGJ95MJF7NO","2367",72260836,"Jelani","Daryl","Parrish","vitae@egestasrhoncus.net","893-187-8115","Computer Science");
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("RLI75RNG1FQ","1159",37848651,"Addison","Quin","Slater","Nullam.velit.dui@in.com","619-588-9630","Computer Science");
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("HBQ13CUK2WQ","6652",30807557,"Rudyard","Georgia","Booth","ut@a.org","993-733-0868","Computer Science");
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("BOG93DUU5LT","2791",54875190,"Iliana","Bo","Patrick","imperdiet.dictum@non.net","689-605-0724","Computer Science");

/* Engineering */
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("SBD73ZRK6YD","3541",23180181,"Ann","Irene","Harding","Donec@ligulaconsectetuerrhoncus.org","859-227-9862","Engineering");
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("WTQ37OHM7UB","1697",75369795,"Zelda","Noelle","Wynn","vestibulum@porttitortellus.co.uk","388-344-6102","Engineering");
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("OCY64AFY8HN","4862",13545341,"Donna","Shad","Avery","sed@eutellus.org","316-656-4825","Engineering");
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("CCW72HEY3AK","1989",77851800,"Sacha","Maxwell","Cannon","dolor.sit.amet@Mauris.net","330-652-1129","Engineering");
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("ESM07RZP2QF","4733",23374832,"Camden","Mary","Barr","ornare.sagittis.felis@Sed.co.uk","540-453-5517","Engineering");
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("EMO75EYD5KG","3769",55483596,"Fleur","Rooney","Sargent","lacinia.at.iaculis@iaculisneceleifend.edu","259-953-5387","Engineering");
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("TWO17OEV7JD","6032",25079449,"Carolyn","Sheila","Rivera","dictum.eu.eleifend@magnaPraesentinterdum.org","281-711-1043","Engineering");
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("OED59XSS8MC","8864",81624116,"Linus","Adrienne","Bullock","adipiscing@eueratsemper.org","216-319-3735","Engineering");
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("TEB15RGZ3JG","8443",41297273,"Leo","Timothy","Rosario","eu.tellus.Phasellus@dolorDonec.co.uk","951-160-1230","Engineering");
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("UUS97NBF4CA","2475",42504729,"Wesley","Fletcher","Justice","purus@ornare.com","490-623-1700","Engineering");
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("SWM44JLA4FK","9132",10523059,"Bertha","Cole","Schultz","non.lacinia@orci.co.uk","417-433-5846","Engineering");
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("KNO90WZC0EL","5431",37982810,"Keaton","Germane","Harrison","eu@ac.org","706-370-7873","Engineering");
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("BHL10DES7KT","3986",14236276,"Doris","MacKenzie","Salazar","blandit.at@parturientmontes.net","382-933-5408","Engineering");
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("MUT79NAY5GW","2490",90589104,"Zeph","Scarlett","Gonzales","montes@nisidictumaugue.edu","682-491-6304","Engineering");
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("SGL24JBH5GP","4202",94114628,"Hammett","Cairo","Sanders","facilisis.magna.tellus@mattissemperdui.com","345-277-2740","Engineering");
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("RBS17VDT3XP","2310",18386132,"Adrienne","Burke","Parks","mollis.Integer.tincidunt@facilisisnon.co.uk","547-577-9784","Engineering");
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("PNH50SUU4ZC","6429",98910786,"Cassandra","Ayanna","Owen","turpis@metuseuerat.net","806-155-8507","Engineering");
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("UNE78GBW7RM","6272",27322001,"Kuame","Barry","Mayer","metus@sitametdiam.org","949-863-0296","Engineering");
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("PGA69XTW3QE","7611",71892655,"Valentine","Bernard","Morse","vel@magnaa.co.uk","932-477-4197","Engineering");
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("MOL86WNZ1FK","9652",57584505,"Vernon","Reuben","Nash","Aliquam.adipiscing.lobortis@Maurisvestibulumneque.org","153-855-5727","Engineering");
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("ALH65GQL6OQ","9642",10544496,"Brooke","Inga","Castro","elementum.purus@enimMauris.org","433-263-2590","Engineering");
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("ZYC18MLE7CI","4324",80030970,"Wayne","Abbot","Ellis","feugiat@estac.net","664-236-6206","Engineering");
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("PSP34YNN0LY","7513",62051688,"Jamal","Raymond","Sanders","montes.nascetur.ridiculus@montes.ca","546-740-6188","Engineering");
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("YKT71IFZ4XV","6554",94167414,"Dieter","Zahir","Hartman","nec.urna.et@Proinmi.ca","334-216-6180","Engineering");
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("RNH09NKV9KB","7714",85123739,"Edward","Gretchen","Graves","consectetuer@enimnec.org","440-531-8405","Engineering");
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("GRS39LFP7WT","9511",93558684,"Nerea","Yael","Levine","cubilia@Aliquam.edu","181-104-0052","Engineering");
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("TUX94OFZ1IM","3504",18385297,"Uma","Jade","Hester","lobortis.ultrices.Vivamus@Nuncmaurissapien.net","831-127-8871","Engineering");
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("JQE27FGO4PZ","4004",87059415,"Adele","Colette","Lewis","vehicula@Pellentesque.edu","702-225-8003","Engineering");
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("IFF55PYV2HE","3405",35789026,"Hadassah","Gwendolyn","Watson","Aenean.eget@neccursusa.org","757-562-8565","Engineering");
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("KXF69LZI7EM","9356",56496171,"Mufutau","Patrick","Gentry","at@risus.org","106-795-3943","Engineering");

/* Biology*/
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("NLG70IXG1EM","6274",28238870,"Joshua","Jasper","Rodgers","adipiscing.ligula.Aenean@ante.com","839-140-2426","Biology");
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("EIE51GYQ5ZD","5390",16894182,"Stuart","Kenneth","Gibson","Sed@ornare.net","939-203-0999","Biology");
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("TFC71ZXL4IV","3341",16545123,"Jeremy","Isabella","Wyatt","et.rutrum@aliquamerosturpis.ca","194-139-5184","Biology");
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("TKK12FGI1GO","6686",20710971,"Laith","Illiana","Shepherd","Suspendisse.tristique.neque@euaccumsansed.com","694-465-0818","Biology");
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("FVZ68XJL1LH","1615",65341524,"Jacob","Isaac","Leon","dictum.ultricies.ligula@egetlaoreet.ca","394-802-2116","Biology");
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("WQY61LKR6PR","5354",27472410,"Martena","Hayley","Chavez","tempor@montesnasceturridiculus.net","523-850-9456","Biology");
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("CCR01IPT8KQ","9139",11065483,"Jolie","Ila","Harvey","erat@maurisaliquam.com","495-194-3232","Biology");
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("VCI07FCL4PI","8587",62336473,"Ignatius","Donovan","Becker","consectetuer@necmauris.org","365-789-8125","Biology");
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("HOG26DZP7GM","7969",38606473,"Brent","Nissim","Graves","lorem.auctor.quis@felisDonectempor.com","537-873-9519","Biology");
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("CDO57KGC2OR","5790",41297591,"Shellie","Keelie","Foster","mi.eleifend@enimmitempor.ca","412-698-1229","Biology");
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("VDH89NSS0XR","6423",12976472,"Denise","Shafira","Mayer","at@nonnisi.org","185-278-7513","Biology");
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("DFF47SUI6TJ","2754",83005526,"Shoshana","Lane","Larsen","vulputate.nisi.sem@luctusvulputate.net","141-528-0236","Biology");
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("WLG10SDG0AD","2699",93617824,"Orson","Clayton","Alston","ante@velit.net","972-406-6078","Biology");
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("COH47XLC8SN","3850",27383421,"Fredericka","Raymond","Holloway","pede@diam.edu","990-280-0218","Biology");
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("GKZ43YZU8DS","4030",45201740,"Merrill","Tarik","Haley","lorem@magnamalesuadavel.org","821-102-8267","Biology");
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("QFP33HLJ4CR","4967",11122640,"Carla","Hasad","Salinas","Nunc.ac.sem@arcuVestibulum.edu","834-505-3238","Biology");
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("KIC61JBI1FR","4011",37337242,"Kessie","Chase","Sosa","et.nunc@non.net","488-910-4428","Biology");
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("AAN96GVN6MA","1780",33410242,"Irene","Asher","Raymond","Fusce.diam.nunc@orciUtsemper.edu","877-240-3691","Biology");
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("FAH36TAC9ZH","2083",64713263,"Tanya","Shelley","Pugh","non@parturientmontesnascetur.net","702-807-8988","Biology");
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("YTQ49ZJA5EJ","3664",32564204,"Hammett","Aquila","Becker","enim.sit.amet@aliquamadipiscing.org","111-385-7182","Biology");
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("CID23JWL2JS","8162",14019309,"Tanya","Raphael","Ramsey","semper.et.lacinia@sitamet.co.uk","661-866-4504","Biology");
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("AFF45PFL3FK","1330",76166846,"Unity","Alisa","Richard","Cras.sed@utpharetra.org","678-648-1661","Biology");
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("WTB55GKE2KN","2385",68526892,"Hilary","Callie","Butler","Fusce.aliquet@nasceturridiculusmus.org","132-842-9508","Biology");
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("ZXY75KLO3PK","9354",68012624,"Zeus","Salvador","Cooke","In.condimentum@eutemporerat.com","282-988-1058","Biology");
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("BST23KOG2KH","4500",49028746,"Merritt","Ira","Hicks","nec.mauris.blandit@luctus.co.uk","271-804-0904","Biology");
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("GXR54OXZ6OU","2651",75552518,"Montana","Quintessa","Cleveland","arcu@pharetraQuisque.net","532-336-0551","Biology");
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("MIO12ENM9HZ","7205",74717095,"Dawn","Emily","Kerr","quam.a@lobortisauguescelerisque.com","162-583-9108","Biology");
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("KPZ78BND1AR","4817",84236795,"Isabelle","Aimee","Floyd","vitae.erat@ornareInfaucibus.net","840-643-3237","Biology");
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("CFU63JXE4LP","8525",46809815,"Zachery","Carson","Odom","mattis.velit.justo@consectetuerrhoncusNullam.org","235-547-0673","Biology");
INSERT INTO Student (username,psw,studentId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("VMH70NPM7DX","3030",35800657,"Colorado","Blaze","Mcclain","pellentesque.eget.dictum@odioAliquam.net","169-985-9358","Biology");

/*Insert Faculty*/
/* Computer Science*/
INSERT INTO Faculty (username,psw,facultyId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("NFP55IRO5UT","5347",20997295,"Gage","Jescie","Dillard","at.risus.Nunc@eratvolutpat.net","996-127-9325","Computer Science");
INSERT INTO Faculty (username,psw,facultyId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("CDG01EKT9VD","4520",62562447,"Lana","Barrett","Vega","nonummy.ut@mi.ca","880-954-7093","Computer Science");
INSERT INTO Faculty (username,psw,facultyId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("PJK66TTK3CG","2681",92002107,"Anthony","Maggie","Cobb","orci.Phasellus.dapibus@tempor.edu","574-420-4353","Computer Science");
INSERT INTO Faculty (username,psw,facultyId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("RSJ19CQH0DE","1839",61477433,"Ezra","Timon","Beach","Nulla@adipiscingelitCurabitur.org","179-149-7965","Computer Science");
INSERT INTO Faculty (username,psw,facultyId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("MAS57LKC3HX","9513",23915192,"Timon","Xenos","Phelps","diam.dictum@iaculisodioNam.ca","147-763-2845","Computer Science");
INSERT INTO Faculty (username,psw,facultyId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("MYX00GOR2SG","3699",76440442,"Walker","Ezekiel","Gillespie","Mauris@Suspendisseeleifend.com","930-701-0326","Computer Science");
INSERT INTO Faculty (username,psw,facultyId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("AJW98KYH6VK","5813",83643034,"Piper","Denton","Cortez","malesuada.augue@eleifendnunc.ca","881-247-1706","Computer Science");
INSERT INTO Faculty (username,psw,facultyId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("TTB51XYC5CT","4090",23562454,"Phoebe","Giacomo","Rush","sodales.purus.in@Curabiturdictum.org","353-550-8648","Computer Science");
INSERT INTO Faculty (username,psw,facultyId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("DHD92IVJ5BX","4458",83832813,"Nehru","Ian","Chaney","non@nonummyacfeugiat.org","584-585-2124","Computer Science");
INSERT INTO Faculty (username,psw,facultyId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("HLA89FUM3QG","4505",25520806,"Duncan","Damian","Preston","ullamcorper@sociisnatoque.ca","490-771-4097","Computer Science");

/* Engineering*/
INSERT INTO Faculty (username,psw,facultyId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("AUX64VGJ3EV","8540",95895964,"Rose","Wanda","Riggs","Etiam.vestibulum@facilisis.ca","546-433-8829","Engineering");
INSERT INTO Faculty (username,psw,facultyId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("RSW98GBK3DQ","9621",23841616,"Unity","Vaughan","Mason","imperdiet.ornare.In@malesuadaaugueut.ca","311-526-1913","Engineering");
INSERT INTO Faculty (username,psw,facultyId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("OEW96THY4ZR","4735",93167715,"Elton","Quon","Conrad","Donec.consectetuer.mauris@ametconsectetueradipiscing.co.uk","954-140-4109","Engineering");
INSERT INTO Faculty (username,psw,facultyId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("FTE44JHV8WJ","5824",24828502,"Jacob","Taylor","Mason","erat.vitae@nec.net","129-995-4169","Engineering");
INSERT INTO Faculty (username,psw,facultyId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("YAK54KAM5PU","1922",50503410,"Amethyst","Cheyenne","Hurley","euismod@maurisutmi.ca","262-240-4622","Engineering");
INSERT INTO Faculty (username,psw,facultyId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("NYN51FFQ5OA","9416",89281202,"Christen","Cameron","Wong","parturient.montes.nascetur@egestas.org","315-155-9892","Engineering");
INSERT INTO Faculty (username,psw,facultyId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("MAE73WJX0GU","8409",49518024,"Eliana","Bradley","Noel","posuere.vulputate.lacus@in.com","202-431-2974","Engineering");
INSERT INTO Faculty (username,psw,facultyId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("FPL10DIU2BU","9296",99779578,"Wang","Linda","Allen","sit@ullamcorpernislarcu.net","228-564-3445","Engineering");
INSERT INTO Faculty (username,psw,facultyId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("YIK97BGS6OE","9427",28002817,"Xavier","Linda","Mitchell","parturient.montes.nascetur@imperdietullamcorper.org","381-859-7496","Engineering");
INSERT INTO Faculty (username,psw,facultyId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("UGA86ILE1AI","8042",11532174,"Bevis","Dana","Pitts","metus.facilisis@cursus.edu","257-415-0873","Engineering");

/* Biology */
INSERT INTO Faculty (username,psw,facultyId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("MCT19SQO9LQ","7187",38947959,"Yuri","Rebekah","Alexander","nec@luctusCurabituregestas.edu","281-896-7679","Biology");
INSERT INTO Faculty (username,psw,facultyId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("EPV51JMH4LS","2997",24474898,"Lavinia","Felix","Lindsey","diam@arcu.edu","761-130-2201","Biology");
INSERT INTO Faculty (username,psw,facultyId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("JKP70VIJ1DO","2449",34486118,"Damon","Regan","Fox","Quisque.nonummy.ipsum@orciluctus.ca","929-702-7016","Biology");
INSERT INTO Faculty (username,psw,facultyId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("QIN38GWR6YT","7056",87853991,"Noble","Eliana","Fuller","urna.nec.luctus@nequetellusimperdiet.net","246-424-4529","Biology");
INSERT INTO Faculty (username,psw,facultyId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("ILF71HZM9JN","7987",51310952,"Lucas","Malik","Moon","vel.venenatis@vulputate.edu","137-613-4976","Biology");
INSERT INTO Faculty (username,psw,facultyId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("OKW58AKQ2JZ","5445",93573174,"Carl","Logan","Suarez","parturient.montes@Inatpede.co.uk","631-495-9213","Biology");
INSERT INTO Faculty (username,psw,facultyId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("IEQ81EBN2HA","5522",35478533,"Sara","Berk","Horn","molestie.sodales.Mauris@cursusluctus.com","284-499-6268","Biology");
INSERT INTO Faculty (username,psw,facultyId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("RTY89ODJ0BI","2144",20527346,"Jolene","Solomon","Blackburn","non.magna@risusodio.org","991-539-4145","Biology");
INSERT INTO Faculty (username,psw,facultyId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("ECU62ZDC0TQ","8581",28717605,"Haley","Guinevere","Mejia","ut.nisi@luctus.ca","470-509-0404","Biology");
INSERT INTO Faculty (username,psw,facultyId,firstName,middleName,lastName,email,phone,departmentName) VALUES ("MHX42IEX0YU","1543",40497890,"Joshua","Rhiannon","Poole","id@suscipitnonummy.ca","841-789-1662","Biology");

