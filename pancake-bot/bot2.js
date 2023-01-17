// Require the necessary discord.js classes
const { Client, Events, GatewayIntentBits } = require('discord.js');
const { token } = require('./auth.json');
 
// Create a new client instance
const client = new Client({ intents: [GatewayIntentBits.Guilds, GatewayIntentBits.GuildMessages, GatewayIntentBits.MessageContent] });
 
// When the client is ready, run this code (only once)
// We use 'c' for the event parameter to keep it separate from the already defined 'client'
client.on("ready", c => {
	console.log(`Ready! Logged in as ${c.user.tag}`);
});
 
client.on("messageCreate", (msg) => {
 
  /*
  if (msg.content === "ping") {
 
    msg.channel.send("pong");
  }
  */
 
  if (msg.content === "?dailies") {
    prediction = challenger();
    msg.channel.send(prediction);
  }
 
})
 
// Log in to Discord with your client's token
client.login(token);
 
 
function challenger(){
  var challengetype = new Array(); 
    ct = 0; 
    challengetype[ct++] = "Walking Quest";
    challengetype[ct++] = "Equip Cubie";
    challengetype[ct++] = "Print Cubie"; 
    challengetype[ct++] = "Forge Key"; 
    challengetype[ct++] = "Open Vaults"; 
 
  var recordtype = new Array(); 
    rt = 0; 
 
  var questtype = new Array(); 
    qt = 0; 
 
  var questdetail = new Array();
    qd = 0; 
 
  var walkingquest = new Array(); 
    wq = 0; 
    walkingquest[wq++] = "Do 3 walking quests"; 
    walkingquest[wq++] = "Do 6 walking quests";
    walkingquest[wq++] = "Do 8 walking quests"; 
 
  var equipeasy = new Array(); 
    ee = 0; 
    equipeasy[ee++] = "Blue";
    equipeasy[ee++] = "Green";
    equipeasy[ee++] = "Turkey"; 
    equipeasy[ee++] = "Santa"; 
    equipeasy[ee++] = "NYE 2021"; 
    equipeasy[ee++] = "Ox"; 
    equipeasy[ee++] = "Construction"; 
    equipeasy[ee++] = "Hula"; 
    equipeasy[ee++] = "Air"; 
    equipeasy[ee++] = "Thanksgiving"; 
    equipeasy[ee++] = "Elf"; 
    equipeasy[ee++] = "NYE 2022"; 
    equipeasy[ee++] = "Tiger"; 
    equipeasy[ee++] = "Pizza"; 
    equipeasy[ee++] = "White"; 
    equipeasy[ee++] = "Marshaller"; 
    equipeasy[ee++] = "Zombie"; 
    equipeasy[ee++] = "Snoozy"; 
    equipeasy[ee++] = "Boba"; 
    equipeasy[ee++] = "Ronda"; 
    equipeasy[ee++] = "Patches"; 
    equipeasy[ee++] = "Jett"; 
    equipeasy[ee++] = "Tiger Lily"; 
    equipeasy[ee++] = "Softy"; 
    equipeasy[ee++] = "Holly"; 
    equipeasy[ee++] = "Missy"; 
    equipeasy[ee++] = "Iki";  
    equipeasy[ee++] = "Kuki"; 
    equipeasy[ee++] = "Kauka"; 
    equipeasy[ee++] = "Wawae"; 
    equipeasy[ee++] = "Ino"; 
    equipeasy[ee++] = "Ka Pu"; 
    equipeasy[ee++] = "Enemi"; 
    equipeasy[ee++] = "Haohao"; 
    equipeasy[ee++] = "Hihiu"; 
    equipeasy[ee++] = "Niho"; 
    equipeasy[ee++] = "Olioli"; 
    equipeasy[ee++] = "Makeneki"; 
    equipeasy[ee++] = "Kopaa"; 
    equipeasy[ee++] = "Mo'o"; 
    equipeasy[ee++] = "Anu"; 
    equipeasy[ee++] = "Pohaku"; 
    equipeasy[ee++] = "Hamau"; 
    equipeasy[ee++] = "Metala"; 
    equipeasy[ee++] = "Kaka"; 
    equipeasy[ee++] = "Paipika"; 
    equipeasy[ee++] = "Hookahi"; 
    equipeasy[ee++] = "Luna"; 
    equipeasy[ee++] = "Kaulana"; 
    equipeasy[ee++] = "Koa"; 
    equipeasy[ee++] = "Nani"; 
    equipeasy[ee++] = "Pila"; 
    equipeasy[ee++] = "Kelepona"; 
 
  var equipmed = new Array(); 
    em = 0; 
    equipmed[em++] = "Yellow"; 
    equipmed[em++] = "Red";
    equipmed[em++] = "Purple";
    equipmed[em++] = "Foreman";
    equipmed[em++] = "Qipao";
    equipmed[em++] = "Valentine";
    equipmed[em++] = "Leprechaun";
    equipmed[em++] = "Monster";
    equipmed[em++] = "Mummy";
    equipmed[em++] = "Rudolph";
    equipmed[em++] = "Doge";
    equipmed[em++] = "Surf";
    equipmed[em++] = "Bitcoin";
    equipmed[em++] = "Canada";
    equipmed[em++] = "USA";
    equipmed[em++] = "Ethereum";
    equipmed[em++] = "Earth";
    equipmed[em++] = "Water";
    equipmed[em++] = "UK";
    equipmed[em++] = "Bitcoin Beach";
    equipmed[em++] = "VeriBlock";
    equipmed[em++] = "Suku";
    equipmed[em++] = "Ice";
    equipmed[em++] = "Sneaky Seal";
    equipmed[em++] = "Summer";
    equipmed[em++] = "RNG";
    equipmed[em++] = "Sushi Chef";
    equipmed[em++] = "Cubie Air Jamie";
    equipmed[em++] = "Cubie Air Natalie";
    equipmed[em++] = "Cubie Air Angela";
 
  var equiphard = new Array(); 
    eh = 0; 
    equiphard[eh++] = "Vampire"; 
    equiphard[eh++] = "Snowman"; 
    equiphard[eh++] = "Fire Dragon"; 
    equiphard[eh++] = "Chill"; 
    equiphard[eh++] = "OG"; 
    equiphard[eh++] = "Pirate"; 
    equiphard[eh++] = "Shark"; 
    equiphard[eh++] = "Fire"; 
    equiphard[eh++] = "Witch"; 
    equiphard[eh++] = "Black Cat"; 
    equiphard[eh++] = "Pat Morita"; 
    equiphard[eh++] = "Gingerbread"; 
    equiphard[eh++] = "Yellow Dragon"; 
    equiphard[eh++] = "Turtle"; 
    equiphard[eh++] = "Tiki Chief"; 
    equiphard[eh++] = "Master Sushi Chef"; 
    equiphard[eh++] = "Cubie Air George"; 
    equiphard[eh++] = "Cubie Air Laura"; 
    equiphard[eh++] = "Wombat"; 
    equiphard[eh++] = "Skeleton"; 
    equiphard[eh++] = "Laura Ghost"; 
    equiphard[eh++] = "George Ghost"; 
 
  var printeasy = new Array() 
    pe = 0; 
    printeasy[pe++] = "Blue";
    printeasy[pe++] = "Green";
    printeasy[pe++] = "Turkey"; 
    printeasy[pe++] = "Santa"; 
    printeasy[pe++] = "NYE 2021"; 
    printeasy[pe++] = "Ox"; 
    printeasy[pe++] = "Construction"; 
    printeasy[pe++] = "Hula"; 
    printeasy[pe++] = "Air"; 
    printeasy[pe++] = "Thanksgiving"; 
    printeasy[pe++] = "Elf"; 
    printeasy[pe++] = "NYE 2022"; 
    printeasy[pe++] = "Tiger"; 
    printeasy[pe++] = "Pizza"; 
    printeasy[pe++] = "White"; 
    printeasy[pe++] = "Marshaller"; 
    printeasy[pe++] = "Zombie"; 
    printeasy[pe++] = "Snoozy"; 
    printeasy[pe++] = "Boba"; 
    printeasy[pe++] = "Ronda"; 
    printeasy[pe++] = "Patches"; 
    printeasy[pe++] = "Jett"; 
    printeasy[pe++] = "Tiger Lily"; 
    printeasy[pe++] = "Softy"; 
    printeasy[pe++] = "Holly"; 
    printeasy[pe++] = "Missy"; 
    printeasy[pe++] = "Iki";  
    printeasy[pe++] = "Kuki"; 
    printeasy[pe++] = "Kauka"; 
    printeasy[pe++] = "Wawae"; 
    printeasy[pe++] = "Ino"; 
    printeasy[pe++] = "Ka Pu"; 
    printeasy[pe++] = "Enemi"; 
    printeasy[pe++] = "Haohao"; 
    printeasy[pe++] = "Niho"; 
    printeasy[pe++] = "Olioli"; 
    printeasy[pe++] = "Makeneki"; 
    printeasy[pe++] = "Kopaa"; 
    printeasy[pe++] = "Mo'o"; 
    printeasy[pe++] = "Anu"; 
    printeasy[pe++] = "Pohaku"; 
    printeasy[pe++] = "Hamau"; 
    printeasy[pe++] = "Metala"; 
    printeasy[pe++] = "Kaka"; 
    printeasy[pe++] = "Paipika"; 
    printeasy[pe++] = "Hookahi"; 
    printeasy[pe++] = "Luna"; 
    printeasy[pe++] = "Kaulana"; 
    printeasy[pe++] = "Koa"; 
    printeasy[pe++] = "Nani"; 
    printeasy[pe++] = "Pila"; 
    printeasy[pe++] = "Kelepona";  
 
  var printmed = new Array(); 
    pm = 0; 
    printmed[pm++] = "Yellow"; 
    printmed[pm++] = "Red";
    printmed[pm++] = "Purple";
    printmed[pm++] = "Foreman";
    printmed[pm++] = "Qipao";
    printmed[pm++] = "Valentine";
    printmed[pm++] = "Leprechaun";
    printmed[pm++] = "Monster";
    printmed[pm++] = "Mummy";
    printmed[pm++] = "Rudolph";
    printmed[pm++] = "Doge";
    printmed[pm++] = "Surf";
    printmed[pm++] = "Bitcoin";
    printmed[pm++] = "Canada";
    printmed[pm++] = "USA";
    printmed[pm++] = "Ethereum";
    printmed[pm++] = "Earth";
    printmed[pm++] = "Water";
    printmed[pm++] = "UK";
    printmed[pm++] = "Bitcoin Beach";
    printmed[pm++] = "VeriBlock";
    printmed[pm++] = "Suku";
    printmed[pm++] = "Ice";
    printmed[pm++] = "Sneaky Seal";
    printmed[pm++] = "Summer";
    printmed[pm++] = "RNG";
    printmed[pm++] = "Sushi Chef";
    printmed[pm++] = "Cubie Air Jamie";
    printmed[pm++] = "Cubie Air Natalie";
    printmed[pm++] = "Cubie Air Angela";
 
  var printhard = new Array(); 
    ph = 0;  
    printhard[ph++] = "Vampire"; 
    printhard[ph++] = "Snowman"; 
    printhard[ph++] = "Fire Dragon"; 
    printhard[ph++] = "Chill"; 
    printhard[ph++] = "OG"; 
    printhard[ph++] = "Pirate"; 
    printhard[ph++] = "Shark"; 
    printhard[ph++] = "Fire"; 
    printhard[ph++] = "Witch"; 
    printhard[ph++] = "Black Cat"; 
    printhard[ph++] = "Pat Morita"; 
    printhard[ph++] = "Gingerbread"; 
    printhard[ph++] = "Yellow Dragon"; 
    printhard[ph++] = "Turtle"; 
    printhard[ph++] = "Tiki Chief"; 
    printhard[ph++] = "Master Sushi Chef"; 
    printhard[ph++] = "Cubie Air George"; 
    printhard[ph++] = "Cubie Air Laura"; 
    printhard[ph++] = "Wombat"; 
    printhard[ph++] = "Skeleton"; 
    printhard[ph++] = "Laura Ghost"; 
    printhard[ph++] = "George Ghost"; 
 
  var forgekey = new Array(); 
    fk = 0; 
    forgekey[fk++] = "Forge green key"; 
    forgekey[fk++] = "Forge yellow key"; 
    forgekey[fk++] = "Forge red key"; 
 
  var openvaults = new Array(); 
    ov = 0; 
    openvaults[ov++] = "Open 5 vaults"; 
    openvaults[ov++] = "Open 15 vaults"; 
    openvaults[ov++] = "Open 50 vaults"; 
 
  function checkpicks(entry) {
    duplicatefound = -1;
 
 
    for (xt=0;xt<rt ;xt++ )
    {
    // scan past picked types of quest
    currententry = recordtype[xt];
    if (entry == currententry)
    {
      duplicatefound = 1;
    } 
    }
 
   return duplicatefound;
 
  }
 
 
  function easyFunction() {
    // selects the easy task of the day
    easy = 0; 
    var selecteasy = Math.floor(Math.random() * ct); 
    var displayeasy = challengetype[selecteasy];
    var challengevalue; 
    recordtype[rt++] = selecteasy;
 
    if (selecteasy == 0) {
      challengevalue = walkingquest[easy];
    }
 
    if (selecteasy == 1) {
      randomcubie = Math.floor(Math.random() * ee); 
      challengevalue = equipeasy[randomcubie];
 
    }
 
    if (selecteasy == 2) {
      randomcubie = Math.floor(Math.random() * pe); 
      challengevalue = printeasy[randomcubie]; 
    }
 
    if (selecteasy == 3) {
      challengevalue = forgekey[easy];
    }
 
    if (selecteasy == 4) {
      challengevalue = openvaults[easy]; 
    }
 
    console.log(selecteasy);
    console.log(recordtype);
    console.log(displayeasy);
    console.log(challengevalue + " easy challenge value"); 
 
    questdetail[qd++] = challengevalue; 
 
  }
 
  function medFunction(){
    // selects the medium task of the day, rerolls if it's the same type as the easy task 
 
    medium = 1; 
    var selectmed = Math.floor(Math.random() * ct); 
    var challengevalue; 
 
    var records = recordtype.length; 
 
    dupecheck = checkpicks(selectmed);
 
    while (dupecheck == 1) {
      selectmed = Math.floor(Math.random() * ct);
      dupecheck = checkpicks(selectmed);
    }
 
 
    var displaymed = challengetype[selectmed]; // bearing goes here
    recordtype[rt++] = selectmed; 
 
    if (selectmed == 0) {
      challengevalue = walkingquest[medium];
    }
 
    if (selectmed == 1) {
      randomcubie = Math.floor(Math.random() * em); 
      challengevalue = equipmed[randomcubie];
    }
 
    if (selectmed == 2) {
      randomcubie = Math.floor(Math.random() * pm); 
      challengevalue = printmed[randomcubie]; 
    }
 
    if (selectmed == 3) {
      challengevalue = forgekey[medium];
    }
 
    if (selectmed == 4) {
      challengevalue = openvaults[medium]; 
    }
 
   console.log(challengevalue + " medium challenge value");
   questdetail[qd++] = challengevalue;
  }
 
  function hardFunction(){
    //selects the hard task of the day, rerolls if it's the same type as the easy or med task
    hard = 2;
    var selecthard = Math.floor(Math.random() * ct);
    var challengevalue; 
 
    dupecheck = checkpicks(selecthard);
 
    while (dupecheck == 1) {
      selecthard = Math.floor(Math.random() * ct);
      dupecheck = checkpicks(selecthard);
    }
 
    var displayhard = challengetype[selecthard];
    recordtype[rt++] = selecthard; 
 
    if (selecthard == 0) {
      challengevalue = walkingquest[hard];
    }
 
    if (selecthard == 1) {
      randomcubie = Math.floor(Math.random() * eh); 
      challengevalue = equiphard[randomcubie];
 
    }
 
    if (selecthard == 2) {
      randomcubie = Math.floor(Math.random() * ph); 
      challengevalue = printhard[randomcubie]; 
    }
 
    if (selecthard == 3) {
      challengevalue = forgekey[hard];
    }
 
    if (selecthard == 4) {
      challengevalue = openvaults[hard]; 
    }
 
   console.log(challengevalue + " hard challenge value");
   questdetail[qd++] = challengevalue;
  }
 
  easyFunction(); 
  medFunction();
  hardFunction();
  console.log(recordtype);
  console.log(questdetail + " quest detail"); 
 
  recordlength = recordtype.length; 
  for (yy = 0; yy < recordlength; yy++) {
    retrieve = recordtype[yy]; 
    display = challengetype[retrieve];
    questtype[qt++]= display; 
  }
 
  console.log(questtype);
 
questtype.forEach((item,index,array) => array[index] = [item]);
questdetail.forEach((item,index,array) => array[index] = [item]);
 
console.log(questtype);
console.log(questdetail);
 
var newDiscordMessage = ":blue_heart: TotoroBot thinks the new Adventure Road dailies will be: \n:green_square: Easy - " + questtype[0] + " - " + questdetail[0] + "\n:yellow_square: Medium - " + questtype[1] + " - " + questdetail[1] + "\n:red_square: Hard - " + questtype[2] + " - " + questdetail[2] + "\n"; 
// get questtype array and get questdetail array 
// spit it out to discord later 
 
return newDiscordMessage;
 
 
}
 
 