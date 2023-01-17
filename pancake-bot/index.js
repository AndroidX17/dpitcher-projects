
//import ButtonCommand from 'button.js';



const Discord = require("discord.js");
const config = require("./config.json");
//const moment = require("moment");

//const Calendar = require('react-calendar');
/*
const querystring = require('querystring');
const https = require('https');
const http = require('http');
const fs = require('fs');*/
const { AudioPlayerStatus, StreamType, createAudioPlayer, createAudioResource, joinVoiceChannel } = require('@discordjs/voice');

//const command = require('./buttons/button.js');
const packageJSON = require("./package.json");
const { Client, Events, Message, GatewayIntentBits, ActionRowBuilder, ButtonBuilder, ButtonStyle, ModalBuilder, Collection, EmbedBuilder  } = require('discord.js');

const ytdl = require('discord-ytdl-core');
const { debug } = require("console");

let messagesID = new Array();
let mID = 0;
let messagesNAME = new Array();
let mNAME = 0;
let messagesDATE = new Array();
let mDATE = 0;
let messagesMAXPLAYERS = new Array();
let mMAXPLAYERS = 0;

let rapidrequest = 0;


function getMaxPlayersFromEventID(eventID) {

  var ourdate = "";


for (x=0;x<mMAXPLAYERS;x++) {


var curID = messagesID[x];

if (curID === eventID) {


ourdate = messagesMAXPLAYERS[x];
console.log("date noted " + ourdate);

}


}



  return ourdate;
}

function getMaxPlayersFromEventName(eventName) {

  var ourdate = "";


for (x=0;x<mMAXPLAYERS;x++) {


var curNAME = messagesNAME[x];

if (curNAME === eventName) {


ourdate = messagesMAXPLAYERS[x];
console.log("date noted " + ourdate);

}


}



  return ourdate;
}


function deleteOriginalCard(message1, messageIDD) {



 
    message1.channel.messages.fetch(messageIDD)
      .then(msg => msg.delete())
      .catch(console.error);

console.log("DELETE EVENT CARD");

}
function getDateFromEventID(eventID) {

  var ourdate = "";


for (x=0;x<mID;x++) {


var curID = messagesID[x];

if (curID === eventID) {


ourdate = messagesDATE[x];
console.log("date noted " + ourdate);

}


}



  return ourdate;
}


function setDateFromEventID(eventID, newdate) {

  var ourdate = "";


for (x=0;x<mID;x++) {


var curID = messagesID[x];

if (curID === eventID) {


messagesDATE[x] = newdate;
console.log("set date noted " + ourdate + " TO " + newdate);

}


}


}

function setMaxPlayersFromEventName(eventName, newmaxplayers) {

  var ourdate = "";


for (x=0;x<mMAXPLAYERS;x++) {


var curNAME = messagesNAME[x];

if (curNAME === eventName) {


messagesMAXPLAYERS[x] = newmaxplayers;
console.log("set maxplayers noted " + ourdate + " TO " + newmaxplayers);

}


}


}

function setDateFromEventName(eventName, newdate) {

  var ourdate = "";


for (x=0;x<mID;x++) {


var curNAME = messagesNAME[x];

if (curNAME === eventName) {


messagesDATE[x] = newdate;
console.log("set date noted " + ourdate + " TO " + newdate);

}


}


}


async function play(connection, url) {
  connection.play(await ytdl(url), { type: 'opus' });
}


/*

function makebutton2(message) {




  const modal = new ModalBuilder()
  .setTitle('Register')
  .setCustomId('reigster')
  .setComponents(
    new ActionRowBuilder().setComponents(
      new Discord.TextInputBuilder()
      .setLabel('username')
      .setCustomId('username')
    //  .setStyle(TextInputStyle.Short)
    ),
  
  );

  message.showModal(modal);



  
}*/

async function makebutton(message) {


let msg = await message.channel.fetchMessage(message.options.get('message-id'))
if(!msg || msg?.author?.id !== client.user.id) return message.reply({ content: "Error..." })


msg.edit({ embeds: ["a defined embed"], components: [row] })

}

//const client = new Discord.Client({intents: ["GUILDS", "GUILD_MESSAGES"]});
const client = new Discord.Client({intents: [
    GatewayIntentBits.Guilds,
GatewayIntentBits.GuildMessages,
GatewayIntentBits.MessageContent,
GatewayIntentBits.GuildMessageReactions, 
GatewayIntentBits.GuildVoiceStates, 


]});

const prefix = "!";

//const functions = fs.readdirSync("./functions").filter(file => file.endsWith(".js"));
//const eventFiles = fs.readdirSync("./events").filter(file => file.endsWith(".js"));

/*
client.buttons = new Collection();

(async () => {
  for (file of functions) {
    require(`./functions/${file}`)(client);
  }

  client.handleEvents(eventFiles, "./events");
client.handleButtons();

})


*/


client.on('ready', function (evt) {
    console.log('r');
  /*
  
    if (message.content === "/test") {
      const embed = new RichEmbed()
      .setTitle('Avatar!')
      .setAuthor("Your Avatar", message.author.avatarURL)
      .setImage(message.author.avatarURL)
      .setColor('RANDOM')
      .setDescription('Avatar URL')
     message.reply(embed)
    }*/
  });

client.on('message', message => {
    console.log(message.content);
  /*
  
    if (message.content === "/test") {
      const embed = new RichEmbed()
      .setTitle('Avatar!')
      .setAuthor("Your Avatar", message.author.avatarURL)
      .setImage(message.author.avatarURL)
      .setColor('RANDOM')
      .setDescription('Avatar URL')
     message.reply(embed)
    }*/
  });


  const emojis = {
    'awesome': '💪',
    'sweet': '👌',
    'woah': '🤯',
  };


var currentconnection = null;


client.on('messageReactionAdd', async (reaction, user) => {
  if (reaction.emoji.name === "🥞") {
    try {
    //  reaction.message.guild.members.find('id', user.id).addRole(reaction.message.guild.roles.find('name', 'Joueur'));

    reaction.message.react('🥞');
    } catch {
 //     console.log('Error : can\'t add the role');
    }
 }
});





async function getInfo(message) {
  const response = await fetch("https://www.onelayerpancake.com/includes/addevent.inc.php", {
    method: 'POST',
    headers: {
      'Accept': 'application/json',
      'Content-Type': 'application/json'
    },
    body: {
       "eventNAME": "testevent",
       "eventDATE": "testest",
       "maxplayer": 5,
       "eventPLAYER1": "bob",
       "eventPLAYER2": "bob2",
       "eventPLAYER3": "bob3",
       "eventPLAYER4": "bob4",
       "eventPLAYER5": "bob5"
      },
    });
    
    response.json().then(data => {
      console.log(data);

      let finalmsg = "";

      if (data[0] == "0") {
        finalmsg = "successful add event";
      }
      if (data[0] == "1") {
        finalmsg = "fail add event";
      }
console.log(finalmsg);

message.reply("succeed");// JSON.stringify(data)
      return finalmsg;
    });

    /*
    response.json().then(data => {
      console.log(data);

      let finalmsg = "";

      if (data[0] == "0") {
        finalmsg = "successful add event";
      }
      if (data[0] == "1") {
        finalmsg = "fail add event";
      }
console.log(finalmsg);

message.reply("succeed");// JSON.stringify(data)
      return finalmsg;
    });

    
     */



}

//require('discord-buttons')(client);

/*
client.on('clickButton', async(button) => {
   console.log(button.id);
});
*/

function adjustId(sentID, eventnamETRIM) {

for (x=0;x<mID;x++) {


var curEven = messagesNAME[x];

if (curEven == eventnamETRIM) {

  console.log("UPDATED RECORDS, changed " + messagesID[x] + " to new value of " + sentID + " FOR ENTRY AT " + x);
messagesID[x] = sentID;

}


}

 // messagesID[mID++] = id; messagesNAME[mNAME++] = eventname;




}

function deleteEventFromArrays(someEventName) {


  var arrayindex = messagesNAME.indexOf(someEventName);

  if (arrayindex != -1) {

    messagesNAME[arrayindex] = "WABAAAAAAAAAAAAABABABABABABA";
   




  }


}


function buildCardForEvent(message, eventnamestrimmed, maxplayerr, dateused) {

  var specialID = -1;

  const row = new ActionRowBuilder()
  .addComponents(
    new ButtonBuilder()
      .setCustomId('primary')
      .setLabel('JOIN!')
      .setStyle(ButtonStyle.Primary),
      
  ).addComponents(
    new ButtonBuilder()
      .setCustomId('secondary')
      .setLabel('LEAVE')
      .setStyle(ButtonStyle.Primary),
      
  );
  
  let randum = Math.round(Math.random()*2)+1;

  if (eventnamestrimmed.toLowerCase().indexOf("ibedor") != -1) {
    randum = 4;
  }
  if (eventnamestrimmed.toLowerCase().indexOf("fang") != -1) {
    randum = 4;
  }
  if (eventnamestrimmed.toLowerCase().indexOf("gyfin") != -1) {
    randum = 5;
  }
  
  if (eventnamestrimmed.toLowerCase().indexOf("ibdor") != -1) {
    randum = 4;
  }
  if (eventnamestrimmed.toLowerCase().indexOf("gyfn") != -1) {
    randum = 5;
  }
  if (eventnamestrimmed.toLowerCase().indexOf("gifn") != -1) {
    randum = 5;
  }
  const exampleEmbed = new EmbedBuilder()
    .setColor(0x0099FF)
    .setTitle('ONELAYERPANCAKE')
    .setURL('https://www.onelayerpancake.com')
    .setAuthor({ name: message.member.displayName, iconURL: 'https://www.onelayerpancake.com/favicon.ico', url: 'https://www.onelayerpancake.com' })
    //.setAuthor({ name: 'Some name', iconURL: 'https://i.imgur.com/AfFp7pu.png', url: 'https://discord.js.org' })
    .setDescription('EVENT CREATOR')
    .setThumbnail('https://www.onelayerpancake.com/OLP2.png')
    .addFields(
      { name: eventnamestrimmed, value: dateused },
      { name: '\u200B', value: '\u200B' },
      { name: 'Max players', value: ''+maxplayerr, inline: true },
    //	{ name: 'Current players', value: '0', inline: true },
    )
  
    //.addFields({ name: 'Inline field title', value: 'Some value here', inline: true })
    .setImage('https://www.onelayerpancake.com/OLP' + randum+'.png')
    .setTimestamp()
    .setFooter({ text: 'To make an event, type /create event EVENT_NAME', iconURL: 'https://www.onelayerpancake.com/favicon.ico' });

    message.channel.send({ embeds: [exampleEmbed],  components: [row] }).then(sent => {let id = sent.id; adjustId(sent.id, eventnamestrimmed); });
    //message.reply("Added a new event with date TBD, max players is 5");

}


function buildCardForEvent5(message, eventnamestrimmed, maxplayerr, dateused, playerinfoo) {

  var specialID = -1;

  let row = new ActionRowBuilder()
  .addComponents(
    new ButtonBuilder()
      .setCustomId('primary')
      .setLabel('JOIN!')
      .setStyle(ButtonStyle.Primary),
      
  ).addComponents(
    new ButtonBuilder()
      .setCustomId('secondary')
      .setLabel('LEAVE')
      .setStyle(ButtonStyle.Primary),
      
  ).addComponents(
    new ButtonBuilder()
      .setCustomId('fourth')
      .setLabel('REFRESH')
      .setStyle(ButtonStyle.Secondary),
      
  );
  
  if (maxplayerr == 3) {
    
  } else {
    row = new ActionRowBuilder()
    .addComponents(
      new ButtonBuilder()
        .setCustomId('primary')
        .setLabel('JOIN!')
        .setStyle(ButtonStyle.Primary),
        
    ).addComponents(
      new ButtonBuilder()
        .setCustomId('secondary')
        .setLabel('LEAVE')
        .setStyle(ButtonStyle.Primary),
        
    ).addComponents(
      new ButtonBuilder()
        .setCustomId('third')
        .setLabel('SET MAX 3')
        .setStyle(ButtonStyle.Secondary),
        
    ).addComponents(
      new ButtonBuilder()
        .setCustomId('fourth')
        .setLabel('REFRESH')
        .setStyle(ButtonStyle.Secondary),
        
    );
    
    }
  
  let randum = Math.round(Math.random()*2)+1;

  if (eventnamestrimmed.toLowerCase().indexOf("ibedor") != -1) {
    randum = 4;
  }
  if (eventnamestrimmed.toLowerCase().indexOf("fang") != -1) {
    randum = 4;
  }
  if (eventnamestrimmed.toLowerCase().indexOf("gyfin") != -1) {
    randum = 5;
  }
  
  if (eventnamestrimmed.toLowerCase().indexOf("ibdor") != -1) {
    randum = 4;
  }
  if (eventnamestrimmed.toLowerCase().indexOf("gyfn") != -1) {
    randum = 5;
  }
  if (eventnamestrimmed.toLowerCase().indexOf("gifn") != -1) {
    randum = 5;
  }
  

  let eventnameURL = "https://www.onelayerpancake.com/guildevent.php";//guildevent.php?eventname=".$eventname;


  let eventnamenospace = eventnamestrimmed.replaceAll(" ", "+");
  
  const eventnameURL2 = eventnameURL + "\?eventname\=" + eventnamenospace;


  const exampleEmbed = new EmbedBuilder()
    .setColor(0x0099FF)
    .setTitle('ONELAYERPANCAKE')
    .setURL(eventnameURL2)
    .setAuthor({ name: message.member.displayName, iconURL: 'https://www.onelayerpancake.com/favicon.ico', url: eventnameURL2 })
    //.setAuthor({ name: 'Some name', iconURL: 'https://i.imgur.com/AfFp7pu.png', url: 'https://discord.js.org' })
    .setDescription('EVENT CREATOR')
    .setThumbnail('https://www.onelayerpancake.com/OLP2.png')
    .addFields(
      { name: eventnamestrimmed, value: dateused },
      { name: '\u200B', value: '\u200B' },
      { name: 'Max players', value: ''+maxplayerr, inline: true },
    	{ name: 'Current players', value: playerinfoo, inline: true },
    )
  
    //.addFields({ name: 'Inline field title', value: 'Some value here', inline: true })
    .setImage('https://www.onelayerpancake.com/OLP' + randum+'.png')
    .setTimestamp()
    .setFooter({ text: 'To make an event, type /create event EVENT_NAME', iconURL: 'https://www.onelayerpancake.com/favicon.ico' });
  message.reply("Updated card for "+eventnamestrimmed+"");

    message.channel.send({ embeds: [exampleEmbed],  components: [row] }).then(sent => {let id = sent.id; adjustId(sent.id, eventnamestrimmed); });
  
}

function buildCardForEvent2(message, eventnamestrimmed, maxplayerr, dateused) {

  var specialID = -1;


  let row = new ActionRowBuilder()
  .addComponents(
    new ButtonBuilder()
      .setCustomId('primary')
      .setLabel('JOIN!')
      .setStyle(ButtonStyle.Primary),
      
  ).addComponents(
    new ButtonBuilder()
      .setCustomId('secondary')
      .setLabel('LEAVE')
      .setStyle(ButtonStyle.Primary),
      
  ).addComponents(
    new ButtonBuilder()
      .setCustomId('fourth')
      .setLabel('REFRESH')
      .setStyle(ButtonStyle.Secondary),
      
  );
  
  if (maxplayerr == 3) {
    
  } else {
    row = new ActionRowBuilder()
    .addComponents(
      new ButtonBuilder()
        .setCustomId('primary')
        .setLabel('JOIN!')
        .setStyle(ButtonStyle.Primary),
        
    ).addComponents(
      new ButtonBuilder()
        .setCustomId('secondary')
        .setLabel('LEAVE')
        .setStyle(ButtonStyle.Primary),
        
    ).addComponents(
      new ButtonBuilder()
        .setCustomId('third')
        .setLabel('SET MAX 3')
        .setStyle(ButtonStyle.Secondary),
        
    ).addComponents(
      new ButtonBuilder()
        .setCustomId('fourth')
        .setLabel('REFRESH')
        .setStyle(ButtonStyle.Secondary),
        
    );
    
    }
  
  let randum = Math.round(Math.random()*2)+1;

  if (eventnamestrimmed.toLowerCase().indexOf("ibedor") != -1) {
    randum = 4;
  }
  if (eventnamestrimmed.toLowerCase().indexOf("fang") != -1) {
    randum = 4;
  }
  if (eventnamestrimmed.toLowerCase().indexOf("gyfin") != -1) {
    randum = 5;
  }
  
  if (eventnamestrimmed.toLowerCase().indexOf("ibdor") != -1) {
    randum = 4;
  }
  if (eventnamestrimmed.toLowerCase().indexOf("gyfn") != -1) {
    randum = 5;
  }
  if (eventnamestrimmed.toLowerCase().indexOf("gifn") != -1) {
    randum = 5;
  }
  

  let eventnameURL = "https://www.onelayerpancake.com/guildevent.php";//guildevent.php?eventname=".$eventname;


  let eventnamenospace = eventnamestrimmed.replaceAll(" ", "+");
  
  const eventnameURL2 = eventnameURL + "\?eventname\=" + eventnamenospace;


  const exampleEmbed = new EmbedBuilder()
    .setColor(0x0099FF)
    .setTitle('ONELAYERPANCAKE')
    .setURL(eventnameURL2)
    .setAuthor({ name: message.member.displayName, iconURL: 'https://www.onelayerpancake.com/favicon.ico', url: eventnameURL2 })
    //.setAuthor({ name: 'Some name', iconURL: 'https://i.imgur.com/AfFp7pu.png', url: 'https://discord.js.org' })
    .setDescription('EVENT CREATOR')
    .setThumbnail('https://www.onelayerpancake.com/OLP2.png')
    .addFields(
      { name: eventnamestrimmed, value: dateused },
      { name: '\u200B', value: '\u200B' },
      { name: 'Max players', value: ''+maxplayerr, inline: true },
    //	{ name: 'Current players', value: '0', inline: true },
    )
  
    //.addFields({ name: 'Inline field title', value: 'Some value here', inline: true })
    .setImage('https://www.onelayerpancake.com/OLP' + randum+'.png')
    .setTimestamp()
    .setFooter({ text: 'To make an event, type /create event EVENT_NAME', iconURL: 'https://www.onelayerpancake.com/favicon.ico' });

    message.channel.send({ embeds: [exampleEmbed],  components: [row] }).then(sent => {let id = sent.id; adjustId(sent.id, eventnamestrimmed); });
    message.reply("Updated "+eventnamestrimmed+" to max 3 players");

}


function buildCardForEvent3(message, eventnamestrimmed, maxplayerr, dateused) {

  var specialID = -1;


  var row = new ActionRowBuilder()
  .addComponents(
    new ButtonBuilder()
      .setCustomId('primary')
      .setLabel('JOIN!')
      .setStyle(ButtonStyle.Primary),
      
  ).addComponents(
    new ButtonBuilder()
      .setCustomId('secondary')
      .setLabel('LEAVE')
      .setStyle(ButtonStyle.Primary),
      
  );
  
  if (maxplayerr == 3) {
    
  } else {
    row = new ActionRowBuilder()
    .addComponents(
      new ButtonBuilder()
        .setCustomId('primary')
        .setLabel('JOIN!')
        .setStyle(ButtonStyle.Primary),
        
    ).addComponents(
      new ButtonBuilder()
        .setCustomId('secondary')
        .setLabel('LEAVE')
        .setStyle(ButtonStyle.Primary),
        
    ).addComponents(
      new ButtonBuilder()
        .setCustomId('third')
        .setLabel('SET MAX 3')
        .setStyle(ButtonStyle.Secondary),
        
    ).addComponents(
      new ButtonBuilder()
        .setCustomId('fourth')
        .setLabel('REFRESH')
        .setStyle(ButtonStyle.Secondary),
        
    );
    
    }
  
    let randum = Math.round(Math.random()*2)+1;

    if (eventnamestrimmed.toLowerCase().indexOf("ibedor") != -1) {
      randum = 4;
    }

    if (eventnamestrimmed.toLowerCase().indexOf("gyfin") != -1) {
      randum = 5;
    }
    
    if (eventnamestrimmed.toLowerCase().indexOf("ibdor") != -1) {
      randum = 4;
    }
    if (eventnamestrimmed.toLowerCase().indexOf("gyfn") != -1) {
      randum = 5;
    }
    if (eventnamestrimmed.toLowerCase().indexOf("gifn") != -1) {
      randum = 5;
    }

    console.log("RANDOM" + randum);
  

    
  let eventnameURL = "https://www.onelayerpancake.com/guildevent.php";//guildevent.php?eventname=".$eventname;


  let eventnamenospace = eventnamestrimmed.replaceAll(" ", "+");
  
  const eventnameURL2 = eventnameURL + "\?eventname\=" + eventnamenospace;



  const exampleEmbed = new EmbedBuilder()
    .setColor(0x0099FF)
    .setTitle('ONELAYERPANCAKE')
    .setURL(eventnameURL2)
    .setAuthor({ name: message.member.displayName, iconURL: 'https://www.onelayerpancake.com/favicon.ico', url: eventnameURL2 })
    //.setAuthor({ name: 'Some name', iconURL: 'https://i.imgur.com/AfFp7pu.png', url: 'https://discord.js.org' })
    .setDescription('EVENT CREATOR')
    .setThumbnail('https://www.onelayerpancake.com/OLP2.png')
    .addFields(
      { name: eventnamestrimmed, value: dateused },
      { name: '\u200B', value: '\u200B' },
      { name: 'Max players', value: ''+maxplayerr, inline: true },
    //	{ name: 'Current players', value: '0', inline: true },
    )
  
    //.addFields({ name: 'Inline field title', value: 'Some value here', inline: true })
    .setImage('https://www.onelayerpancake.com/OLP' + randum+'.png')
    .setTimestamp()
    .setFooter({ text: 'To make an event, type /create event EVENT_NAME', iconURL: 'https://www.onelayerpancake.com/favicon.ico' });

    message.channel.send({ embeds: [exampleEmbed],  components: [row] }).then(sent => {let id = sent.id; adjustId(sent.id, eventnamestrimmed); });
    message.reply("Updated "+eventnamestrimmed+" to max " + maxplayerr + " players" + " on date " + dateused);

}
// stutters if people are typing in the discord?
client.on("messageCreate", function(message) {




  if (message.author.bot) return;




  if (message.mentions.has(client.user.id)) {
  //  message.channel.send("Hello there!");

  var msgToLower = message.content.toLowerCase();

  if (msgToLower.indexOf("hello") != -1 || msgToLower.indexOf("hi") != -1) {

    message.reply(`${message.author} heyo!`);  
    return;
  }
if (msgToLower.indexOf("help") != -1 || msgToLower.indexOf("how") != -1 || msgToLower.indexOf("what") != -1 || msgToLower.indexOf("commands") != -1) {

   message.reply(`${message.author} PANCAKE-BOT knows these commands: /play URL, /stop, !giveroles, !ping, !trance, !stats, /create event EVENTNAME, /delete EVENT_NAME, /update EVENT_NAME DATE, /showevents, /join EVENT_NAME`);   
  }


 //  const message = `${user} has been muted`;
 }

  if (message.content.indexOf("-") != -1) {
 
   const str = message.content;
   const count = (str.match(/-/g) || []).length;

   console.log("HYPHENSS?"+ count);

   if (count > 2) {

   console.log("POSSIBLE CODE");

var indexOfFirstHyphen = str.indexOf("-");

var restofstring = str.substring(indexOfFirstHyphen+1,str.length);
console.log("restofstring" + restofstring);
var indexOfSecondHyphen =restofstring.indexOf("-");



var restofstring2 = restofstring.substring(indexOfSecondHyphen+1,restofstring.length);
console.log("restofstring2" + restofstring2);
var indexOfThirdHyphen =restofstring2.indexOf("-");

var subtraction1 = indexOfSecondHyphen - indexOfFirstHyphen;

var subtraction2 = indexOfThirdHyphen - indexOfSecondHyphen;

console.log(indexOfSecondHyphen + "///" + indexOfThirdHyphen);



   var foundcode = false;

   if (indexOfSecondHyphen == 4 && indexOfThirdHyphen == 4) {

foundcode = true;


   }

// client.emojis.find(emoji => emoji.name === "bean") 

   if (foundcode) {
   var random = Math.round(Math.random()*6);

   
    if (random == 0) {
      message.react('🥞');
    }
    if (random == 1) {
      message.react('🙏');
    }

    if (random == 2) {
      message.react('🙏');
    }

    if (random == 3) {
      message.react('❤');
    }

    if (random == 4) {
      message.react('🙏');
    }

    if (random == 5) {
      message.react('🥞');
    }
    if (random == 6) {
      message.react('❤');
    }

  }




   }


  }
  if (message.content == "/stop") {
 
 
    if (currentconnection != null) {

      currentconnection.destroy();
      currentconnection = null;
    } else {

      message.reply(`there is no song to stop playing`);   

      
    }



  }



  



  if (message.content.indexOf("/play ") == 0) {



    if (currentconnection != null) {

      currentconnection.destroy();
      currentconnection = null;
    } 

   // npm install ytdl-core
   // npm install discord-ytdl-core
    
   // npm i ffmpeg-static


const term = "/play ";

const message1 = message.content;

  const url = message1.substring(message1.indexOf(term)+term.length,message1.length);
  console.log(url);




  if(!message.member.voice.channel) return message.channel.send("Please connect to a voice channel!"); //If you are not in the voice channel, then return a message
  // message.member.voice.channel.join(); 

  const connection = joinVoiceChannel({
   channelId: message.member.voice.channel.id,
   guildId: message.guild.id,
   adapterCreator: message.guild.voiceAdapterCreator,
   selfDeaf: false
})

currentconnection = connection;
/*
const stream = ytdl('twkb6WkR6zE', {
filter:'audioonly',
quality: 'highestaudio',
highWaterMark: 1 << 25
});*/


let stream = ytdl(url, {
filter : "audioonly",
opusEncoded : false,
fmt : "mp3",
highWaterMark: 1<<25,
encoderArgs: ['-af', 'bass=g=10,dynaudnorm=f=200','-vn'] 
});
// highWaterMark 
// npm install  ffmpeg fluent-ffmpeg
// -reconnect 1 -reconnect_streamed 1 -reconnect_delay_max 
const player = createAudioPlayer();

//quality: 'highestaudio', highWaterMark: 1024 * 1024 * 10
// this guy says no issues

//  This can be solved by simply reopening the connection and using a Range header to resume where u left off.

//With ffmpeg based connections this can be done by including -reconnect 1 -reconnect_streamed 1 -reconnect_delay_max 4 in the ffmpeg arguments. Which you may notice that these are missing from discord.js's BasePlayer
//
const resource = createAudioResource(stream, {
inputType: StreamType.Arbitrary,
});

// this.queue[0].getLink()

player.play(resource);
connection.subscribe(player);


//const dispatcher = connection.playStream(stream);
        player.on('end', reason => {
			console.log("reason: "+reason);
        });

        player.on('error', err => console.error(err));

player.on(AudioPlayerStatus.Idle, () => connection.destroy());





  }

  const somecontent = message.content;

  const termy775b = "/fix ";
  if (somecontent.indexOf(termy775b) != -1) {

    message.reply("Fixed");
rapidrequest = 0;
  }



  const termy77511 = "/setmaxplayersthree ";
  if (somecontent.indexOf(termy77511) != -1) {


    let eventnames = somecontent.substring(somecontent.indexOf(termy77511) + termy77511.length, somecontent.length);
    console.log("event name" + eventnames);
    
 // message.reply(eventnames + `MAX PLAYERS SET TO 3`);   

  const eventnamestrimmed =eventnames.trim();



  fetch('https://www.onelayerpancake.com/includes/setmaxplayerthree.inc.php', {
    method: 'POST',
    headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json'
    },
    body: JSON.stringify({ 
      "id": 78912,
      "eventname": eventnamestrimmed
    
    
    })
})
.then(response => response.text().then(function (text) {  // 0 3 6 7 8 9
console.log(text);
  if (text[0] === "3") { console.log(text); /*message.reply("Set max players to 3");*/




  buildCardForEvent(message, eventnamestrimmed, 3, "TBD");





} else if (text[0] === "8") { console.log(text); message.reply("Failed to Set max players to 3, no such event"); } else if (text[0] === "6") { console.log(text); message.reply("Max players was already 3"); } else if (text[0] === "0") { console.log(text); message.reply("Something didn't go right"); } }
))


  
  }
  



  const termy7751 = "/max3 ";
  if (somecontent.indexOf(termy7751) != -1) {


    let eventnames = somecontent.substring(somecontent.indexOf(termy7751) + termy7751.length, somecontent.length);
    console.log("event name" + eventnames);
    
 // message.reply(eventnames + `MAX PLAYERS SET TO 3`);   

  const eventnamestrimmed =eventnames.trim();



  fetch('https://www.onelayerpancake.com/includes/setmaxplayerthree.inc.php', {
    method: 'POST',
    headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json'
    },
    body: JSON.stringify({ 
      "id": 78912,
      "eventname": eventnamestrimmed
    
    
    })
})
.then(response => response.text().then(function (text) {  // 0 3 6 7 8 9
console.log(text);
  if (text[0] === "3") { console.log(text); /*message.reply("Set max players to 3");*/


/*
    
  const row = new ActionRowBuilder()
  .addComponents(
    new ButtonBuilder()
      .setCustomId('primary')
      .setLabel('JOIN!')
      .setStyle(ButtonStyle.Primary),
      
  ).addComponents(
    new ButtonBuilder()
      .setCustomId('secondary')
      .setLabel('LEAVE')
      .setStyle(ButtonStyle.Primary),
      
  );
  
  const randum = Math.round(Math.random()*2)+1;
  
  const exampleEmbed = new EmbedBuilder()
    .setColor(0x0099FF)
    .setTitle('ONELAYERPANCAKE')
    .setURL('https://www.onelayerpancake.com')
    .setAuthor({ name: message.member.displayName, iconURL: 'https://www.onelayerpancake.com/favicon.ico', url: 'https://www.onelayerpancake.com' })
    //.setAuthor({ name: 'Some name', iconURL: 'https://i.imgur.com/AfFp7pu.png', url: 'https://discord.js.org' })
    .setDescription('EVENT CREATOR')
    .setThumbnail('https://www.onelayerpancake.com/OLP2.png')
    .addFields(
      { name: eventnamestrimmed, value: 'TBD' },
      { name: '\u200B', value: '\u200B' },
      { name: 'Max players', value: '3', inline: true },
    //	{ name: 'Current players', value: '0', inline: true },
    )
  
    //.addFields({ name: 'Inline field title', value: 'Some value here', inline: true })
    .setImage('https://www.onelayerpancake.com/OLP' + randum+'.png')
    .setTimestamp()
    .setFooter({ text: 'To make an event, type /create event EVENT_NAME', iconURL: 'https://www.onelayerpancake.com/favicon.ico' });
  
    message.channel.send({ embeds: [exampleEmbed],  components: [row] }).then(sent => {let id = sent.id; console.log("ID: " + id); messagesID[mID++] = id; messagesNAME[mNAME++] = eventname;});
    //message.reply("Added a new event with date TBD, max players is 5");
    */
    


} else if (text[0] === "8") { console.log(text); message.reply("Failed to Set max players to 3, no such event"); } else if (text[0] === "6") { console.log(text); message.reply("Update row failure"); } else if (text[0] === "0") { console.log(text); message.reply("Something didn't go right"); } }
))










  
  }
  

  
  const termy61 = "/calendar";
  if (somecontent.indexOf(termy61) != -1) {



    const row = new ActionRowBuilder()
    .addComponents(
      new ButtonBuilder()
        .setCustomId('primary')
        .setLabel('JOIN!')
        .setStyle(ButtonStyle.Primary),
        
    ).addComponents(
      new ButtonBuilder()
        .setCustomId('secondary')
        .setLabel('LEAVE')
        .setStyle(ButtonStyle.Primary),
        
    );


    const eventname = "GYFIN";
    const exampleEmbed = new EmbedBuilder()
      .setColor(0x0099FF)
      .setTitle('ONELAYERPANCAKE')
      .setURL('https://www.onelayerpancake.com')
      .setAuthor({ name: 'Android17', iconURL: 'https://www.onelayerpancake.com/favicon.ico', url: 'https://www.onelayerpancake.com' })
      //.setAuthor({ name: 'Some name', iconURL: 'https://i.imgur.com/AfFp7pu.png', url: 'https://discord.js.org' })
      .setDescription('EVENT CREATOR')
      .setThumbnail('https://www.onelayerpancake.com/OLP2.png')
      .addFields(
        { name: 'GYFIN GROUP', value: 'Tomorrow' },
        { name: '\u200B', value: '\u200B' },
        { name: 'Max players', value: '5', inline: true },
        { name: 'Current players', value: '0', inline: true },
      )
    
      //.addFields({ name: 'Inline field title', value: 'Some value here', inline: true })
      .setImage('https://www.onelayerpancake.com/OLP1.png')
      .setTimestamp()
      .setFooter({ text: 'To make an event, type /create event EVENT_NAME', iconURL: 'https://www.onelayerpancake.com/favicon.ico' });
    
     // message.channel.send({ embeds: [exampleEmbed],  components: [row] }); //.then(sent => {let id = sent.id; console.log("ID: " + id); messagesID[mID++] = id; messagesNAME[mNAME++] = eventname;});;
    
     console.log("THEN");
      message.channel.send({ embeds: [exampleEmbed],  components: [row] }).then(sentEmbed => { console.log("REACT" + message.member.id); 
      sentEmbed.react('👍').then(() => sentEmbed.react('👎')); // U+1F4C5 // \u0031 1285
    //  sentEmbed.react('📅'); // U+1F4C5 // \u0031 1285

    const filter = (reaction, user) => {
      return ['👍', '👎'].includes(reaction.emoji.name) && user.id === message.member.id;
    };


    sentEmbed.awaitReactions({ filter, max: 1, time: 60000, errors: ['time'] })
    .then(collected => {
      const reaction = collected.first();
  
      if (reaction.emoji.name === '👍') {

        const date = moment(reaction.emoji.createdAt).format('MM/DD/YYYY');
        console.log("next thing" + date);
     
              const newEmbed = new EmbedBuilder()
      .setColor(0x0099FF)
      .setTitle('ONELAYERPANCAKE')
      .setURL('https://www.onelayerpancake.com')
      .setAuthor({ name: 'Android17', iconURL: 'https://www.onelayerpancake.com/favicon.ico', url: 'https://www.onelayerpancake.com' })
      //.setAuthor({ name: 'Some name', iconURL: 'https://i.imgur.com/AfFp7pu.png', url: 'https://discord.js.org' })
      .setDescription('EVENT CREATOR')
      .setThumbnail('https://www.onelayerpancake.com/OLP2.png')
      .addFields(
        { name: 'GYFIN GROUP', value: 'Tomorrow' },
        { name: '\u200B', value: '\u200B' },
        { name: 'Max players', value: '5', inline: true },
        { name: 'Current players', value: '0', inline: true },
      )
    
      //.addFields({ name: 'Inline field title', value: 'Some value here', inline: true })
      .setImage('https://www.onelayerpancake.com/OLP1.png')
      .setTimestamp()
      .setFooter({ text: 'To make an event, type /create event EVENT_NAME', iconURL: 'https://www.onelayerpancake.com/favicon.ico' });

        sentEmbed.reply('You reacted with a thumbs up.');
      } else {



        sentEmbed.reply('You reacted with a thumbs down.');





      }
    })
    .catch(collected => {
      sentEmbed.reply('You reacted with neither a thumbs up, nor a thumbs down.');
    });
    /*8
        const filter = (reaction, user) => {
          
          console.log("FILTERING");
          return ['👍', '👎'].includes(reaction.emoji.name) && user.id === message.member.id;
          //return reaction.emoji.name === '👍' && user.id === message.member.id;
          //return true;
        };
         const newEmbed = new EmbedBuilder()
                    .setTitle("You selected:")
                    .setDescription("date")
                    .setColor("0xffffff")
                    .setTimestamp()
                    .setFooter('Powered by Moment.js');

        console.log("HERE");
         sentEmbed.awaitReactions(filter, { max: 1, time: 60000, errors: ['time'] })
          .then(collected => {
            console.log("asdasdas");*/
            /*
            const reaction = collected.first();


            if (reaction.emoji.name === "👍") {
              console.log("EMOJI");
            }


            const date = moment(reaction.emoji.createdAt).format('MM/DD/YYYY');
  console.log("next thing");
            const newEmbed = new EmbedBuilder()
              .setTitle("You selected:")
              .setDescription(date)
              .setColor(0xffffff)
              .setTimestamp()
              .setFooter('Powered by Moment.js');
  
            message.channel.send({ embeds: [newEmbed],  components: [row] });

*/
  });

  console.log("HERE2");
  }
//});

//}

  const termy775 = "/help";
  if (somecontent.indexOf(termy775) != -1) {

  message.reply(`${message.author} PANCAKE-BOT knows these commands: /play URL, /stop, !giveroles, !ping, !trance, !stats, /create event EVENTNAME, /delete EVENT_NAME, /update EVENT_NAME DATE, /showevents, /join EVENT_NAME`);   

  }
  
  const termy77 = "/commands";
  if (somecontent.indexOf(termy77) != -1) {

  message.reply(`${message.author} PANCAKE-BOT knows these commands: /play URL, /stop, !giveroles, !ping, !trance, !stats, /create event EVENTNAME, /delete EVENT_NAME, /update EVENT_NAME DATE, /showevents, /join EVENT_NAME`);   

  }

  const termy6 = "/button";
  if (somecontent.indexOf(termy6) != -1) {

// client.handleButtons();

//message.reply("BUTTON IS NO TWORKING");
//command.run(client, message, args);

/*
let embed = new MessageEmbed()
.setColor('RANDOM')
.setTitle('Choose a reaction for more info about a command!')
.setDescription(
  'Choosing a reaction will allow you to get more info about a specific command!\n\n' +
    `${purge} for purge help\n\n` +
    `${music} for music help\n\n` +
    `${ban} for ban help\n\n`,
);*/
const row = new ActionRowBuilder()
.addComponents(
  new ButtonBuilder()
    .setCustomId('primary')
    .setLabel('JOIN!')
    .setStyle(ButtonStyle.Primary),
    
).addComponents(
  new ButtonBuilder()
    .setCustomId('secondary')
    .setLabel('LEAVE')
    .setStyle(ButtonStyle.Primary),
    
);
/*
const row2 = new ActionRowBuilder()
.addComponents(
  new ButtonBuilder()
    .setCustomId('primary2')
    .setLabel('Click me!2')
    .setStyle(ButtonStyle.Primary),
    
).addComponents(
  new ButtonBuilder()
    .setCustomId('primary3')
    .setLabel('Click me!3')
    .setStyle(ButtonStyle.Primary),
    
).addComponents(
  new ButtonBuilder()
    .setCustomId('primary4')
    .setLabel('Click me!3')
    .setStyle(ButtonStyle.Primary),
    
).addComponents(
  new ButtonBuilder()
    .setCustomId('primary5')
    .setLabel('Click me!3')
    .setStyle(ButtonStyle.Primary),
    
).addComponents(
  new ButtonBuilder()
    .setCustomId('primary6')
    .setLabel('Click me!3')
    .setStyle(ButtonStyle.Primary),
    
);*/
const eventname = "GYFIN";
const exampleEmbed = new EmbedBuilder()
	.setColor(0x0099FF)
	.setTitle('ONELAYERPANCAKE')
	.setURL('https://www.onelayerpancake.com')
	.setAuthor({ name: 'Android17', iconURL: 'https://www.onelayerpancake.com/favicon.ico', url: 'https://www.onelayerpancake.com' })
	//.setAuthor({ name: 'Some name', iconURL: 'https://i.imgur.com/AfFp7pu.png', url: 'https://discord.js.org' })
	.setDescription('EVENT CREATOR')
	.setThumbnail('https://www.onelayerpancake.com/OLP2.png')
	.addFields(
		{ name: 'GYFIN GROUP', value: 'Tomorrow' },
		{ name: '\u200B', value: '\u200B' },
		{ name: 'Max players', value: '5', inline: true },
		{ name: 'Current players', value: '0', inline: true },
	)

	//.addFields({ name: 'Inline field title', value: 'Some value here', inline: true })
	.setImage('https://www.onelayerpancake.com/OLP1.png')
	.setTimestamp()
	.setFooter({ text: 'To make an event, type /create event EVENT_NAME', iconURL: 'https://www.onelayerpancake.com/favicon.ico' });

  message.channel.send({ embeds: [exampleEmbed],  components: [row] }).then(sent => {let id = sent.id; console.log("ID: " + id); messagesID[mID++] = id; messagesNAME[mNAME++] = eventname;});;


//message.channel.send(embed);
/*
   const embed = new Discord.EmbedBuilder()
      .setTitle('Button')
      .setDescription('Click the button below to visit the website.')
      .setURL('https://www.onelayerpancake.com/') 
      .setColor('#0099ff')
      .setTimestamp()
      .setFooter('Button', 'https://i.imgur.com/wSTFkRM.png');
    message.channel.send(embed);
*/
    /*
    Events.InteractionCreate, async interaction => {
      if (!interaction.isChatInputCommand()) return;
    
      if (interaction.commandName === 'button') {
        const row = new ActionRowBuilder()
          .addComponents(
            new ButtonBuilder()
              .setCustomId('primary')
              .setLabel('Click me!')
              .setStyle(ButtonStyle.Primary),
          );
    
        await interaction.reply({ content: 'I think you should,', components: [row] });
      }


  }
*/
//makebutton2(message);

  }


  const termy5 = "/delete ";
  if (somecontent.indexOf(termy5) != -1) {

// who spoke?

// event name?


let eventnames = somecontent.substring(somecontent.indexOf(termy5) + termy5.length, somecontent.length);
console.log("event name" + eventnames);
const eventnamestrimmed =eventnames.trim();


//const eventnamestrimmed =eventnames.trim();

    fetch('https://www.onelayerpancake.com/includes/deleteevent.inc.php', {
        method: 'POST',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ 
          "id": 78912,
          "eventname": eventnamestrimmed
        
        
        })
    })
    .then(response => response.text().then(function (text) {  // 0 3 6 7 8 9
console.log(text);
      if (text[0] === "0") { console.log(text); deleteEventFromArrays(eventnamestrimmed); message.reply("Event deleted"); } else if (text[0] === "8") { console.log(text); message.reply("Failed to delete event, no such event"); } else if (text[0] === "6") { console.log(text); message.reply("Update row failure"); } else if (text[0] === "0") { console.log(text); message.reply("Something didn't go right"); } }
))





  }




  const termy4 = "/update event ";
  if (somecontent.indexOf(termy4) != -1) {

// who spoke?

// event name?

const termy44 = "-";
if (somecontent.indexOf(termy44) == -1) {


       message.reply("Make sure to add a hyphen before the date");
     
} else {




let eventnames = somecontent.substring(somecontent.indexOf(termy4) + termy4.length, somecontent.indexOf(termy44));
if (eventnames.substring(eventnames.length-1,eventnames.length == " ")) {
  eventnames = eventnames.substring(0, eventnames.length-1);
}
console.log("event name" + eventnames);


if (eventnames[0] === " ") {

  eventnames = eventnames.substring(1,eventnames.length);
}


  const eventdate = somecontent.substring(somecontent.indexOf("-") + 1, somecontent.length);
// const eventnamepartial = eventnames.substring(0, eventnames.indexOf("-"));
  const eventnametrimmed = eventnames; //.trim();
 console.log("TRIM RESULT: " + eventnametrimmed);
//const eventnamestrimmed =eventnames.trim();

    fetch('https://www.onelayerpancake.com/includes/updatedate.inc.php', {
        method: 'POST',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ 
          "id": 78912,
          "eventname": eventnametrimmed,
          "eventdate": eventdate
        
        
        })
    })
    .then(response => response.text().then(function (text) {  // 0 3 6 7 8 9
console.log(text);
      if (text[0] === "3") { 
        
        console.log(text); 
        setDateFromEventName(eventnametrimmed, eventdate);
     //   message.reply("Event date updated");
      var currentmax = getMaxPlayersFromEventName(eventnametrimmed);
        buildCardForEvent3(message, eventnametrimmed, currentmax, eventdate);
      
      

      
      
      } else if (text[0] === "8") { console.log(text); message.reply("Failed to update event, no such event"); } else if (text[0] === "6") { console.log(text); message.reply("Update row failure"); } else if (text[0] === "0") { console.log(text); message.reply("Something didn't go right"); } }
))



  

}

  }



  const termy3 = "/join ";
  if (somecontent.indexOf(termy3) != -1) {

// who spoke?

// event name?


let eventnames = somecontent.substring(somecontent.indexOf(termy3) + termy3.length, somecontent.length);
console.log("event name" + eventnames);

const eventnamestrimmed =eventnames.trim();

const playernames = message.member.displayName;
console.log("WHO SENT" + message.member.displayName);
    fetch('https://www.onelayerpancake.com/includes/registerforevent.inc.php', {
        method: 'POST',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ 
          "id": 78912,
          "eventname": eventnamestrimmed,
          "playername": playernames
        
        
        })
    })
    .then(response => response.text().then(function (text) {  // 0 3 6 7 8 9
console.log(text);
      if (text[0] === "0") { console.log(text); message.reply("You've been added to the event"); } else if (text[0] === "T") { console.log(text); message.reply("Player already in the party"); } else if (text[0] === "2") { console.log(text); message.reply("Added player as the fifth and final player"); } else if (text[0] === "4") { console.log(text); message.reply("Added player as fourth player"); } else if (text[0] === "1") { console.log(text); message.reply("Added player as third joiner"); } else if (text[0] === "5") { console.log(text); message.reply("Added player as second to join"); } else if (text[0] === "9") { console.log(text); message.reply("Invalid request"); }  else if (text[0] === "3") { console.log(text); message.reply("Added player as first joiner"); } else if (text[0] === "6") { console.log(text); message.reply("Unable to add, could not insert"); }  else if (text[0] === "7") { console.log(text); message.reply("Unable to add, the event is full"); } else if (text[0] === "8") {  console.log(text); message.reply("Unable to add, no event exists"); } else { console.log(text); message.reply("Unable to add, unknown error"); }




      }))



  }







  const termy2 = "/showevents";
  if (somecontent.indexOf(termy2) != -1) {


    fetch('https://www.onelayerpancake.com/includes/showevents.inc.php', {
        method: 'POST',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ 
          "id": 78912,
        
        
        })
    })
    .then(response => response.text().then(function (text) { console.log(text); const text2 = text.substring(3, text.length); const resultsArray = text2.split("`t"); let eventsString = "There are " + resultsArray.length + " events: "; for(x=0;x<resultsArray.length;x++) { console.log(resultsArray[x]); eventsString += resultsArray[x]; if (x != resultsArray.length - 1) { eventsString += ", "; }  } message.reply(eventsString);  }))

    //.then(response => response.json())


   // .then(response => console.log(JSON.stringify(response)))
   


  }


  
  const termy11 = "/create event ";
  if (somecontent.indexOf(termy11) != -1) {


    let eventname = somecontent.substring(somecontent.indexOf(termy11) + termy11.length, somecontent.length);
    console.log("event name" + eventname);
    eventname = eventname.trim();
    console.log("event name postrim" + eventname);


    if (eventname === "") {
    
      eventname = "DEFAULT_EVENT_NAME";
    }
    



for (x=0;x<mID;x++) {


var curName = messagesNAME[x++];

if (curName === eventname) {
    message.reply("Event already exists");
  return;
}
}


if (somecontent.indexOf("-") != -1) {
  message.reply("Dont use hyphen pls");
  return;


}



    fetch('https://www.onelayerpancake.com/includes/addevent.inc.php', {
        method: 'POST',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ 
          "id": 78912,
          "eventname": eventname,
          "eventdate": "TBD",
          "maxplayers": 5,
          "player1": "unknown",
          "player2": "unknown",
          "player3": "unknown",
          "player4": "unknown",
          "player5": "unknown"
        
        
        
        })
    })
    .then(response => response.json())
    .then(response => { 
      
      
    
const row = new ActionRowBuilder()
.addComponents(
  new ButtonBuilder()
    .setCustomId('primary')
    .setLabel('JOIN!')
    .setStyle(ButtonStyle.Primary),
    
).addComponents(
  new ButtonBuilder()
    .setCustomId('secondary')
    .setLabel('LEAVE')
    .setStyle(ButtonStyle.Primary),
    
).addComponents(
  new ButtonBuilder()
    .setCustomId('third')
    .setLabel('SET MAX 3')
    .setStyle(ButtonStyle.Secondary),
    
).addComponents(
  new ButtonBuilder()
    .setCustomId('fourth')
    .setLabel('REFRESH')
    .setStyle(ButtonStyle.Secondary),
    
);

let randum = Math.round(Math.random()*2)+1;

if (eventname.toLowerCase().indexOf("ibedor") != -1) {
  randum = 4;
}
if (eventname.toLowerCase().indexOf("fang") != -1) {
  randum = 4;
}
if (eventname.toLowerCase().indexOf("gyfin") != -1) {
  randum = 5;
}

if (eventname.toLowerCase().indexOf("ibdor") != -1) {
  randum = 4;
}
if (eventname.toLowerCase().indexOf("gyfn") != -1) {
  randum = 5;
}
if (eventname.toLowerCase().indexOf("gifn") != -1) {
  randum = 5;
}

let eventnameURL = "https://www.onelayerpancake.com/guildevent.php";//guildevent.php?eventname=".$eventname;


let eventnamenospace = eventname.replaceAll(" ", "+");

const eventnameURL2 = eventnameURL + "\?eventname\=" + eventnamenospace;

console.log(eventnameURL2);
const exampleEmbed = new EmbedBuilder()
	.setColor(0x0099FF)
	.setTitle('ONELAYERPANCAKE')
	.setURL(eventnameURL2)
	.setAuthor({ name: message.member.displayName, iconURL: 'https://www.onelayerpancake.com/favicon.ico', url: eventnameURL2 })
	//.setAuthor({ name: 'Some name', iconURL: 'https://i.imgur.com/AfFp7pu.png', url: 'https://discord.js.org' })
	.setDescription('EVENT CREATOR')
	.setThumbnail('https://www.onelayerpancake.com/OLP2.png')
	.addFields(
		{ name: eventname, value: 'TBD, change with link, or use /update event '+eventname+ ' -EVENT_DATE' },
		{ name: '\u200B', value: '\u200B' },
		{ name: 'Max players', value: '5', inline: true },
	//	{ name: 'Current players', value: '0', inline: true },
	)

  
	//.addFields({ name: 'Inline field title', value: 'Some value here', inline: true })
	.setImage('https://www.onelayerpancake.com/OLP' + randum+'.png')
	.setTimestamp()
	.setFooter({ text: 'To make an event, type /create event EVENT_NAME', iconURL: 'https://www.onelayerpancake.com/favicon.ico' });

  message.channel.send({ embeds: [exampleEmbed],  components: [row] }).then(sent => {let id = sent.id; console.log("ID: " + id); messagesID[mID++] = id; messagesNAME[mNAME++] = eventname; messagesDATE[mDATE++] = 'TBD'; messagesMAXPLAYERS[mMAXPLAYERS++] = 5;});
  //message.reply("Added a new event with date TBD, max players is 5");
  
  
  })

// real one

    
      }


  const termy = "/add event ";
  if (somecontent.indexOf(termy) != -1) {


    let eventname = somecontent.substring(somecontent.indexOf(termy) + termy.length, somecontent.length);
    console.log("event name" + eventname);
    eventname = eventname.trim();
        /*
        https.get('https://www.onelayerpancake.com/includes/addevent.inc.php', res => {
          let data = [];
          const headerDate = res.headers && res.headers.date ? res.headers.date : 'no response date';
          console.log('Status Code:', res.statusCode);
          console.log('Date in Response header:', headerDate);
        
          res.on('data', chunk => {
            data.push(chunk);
          });
        
          res.on('end', () => {
            console.log('Response ended: ');
            const users = JSON.parse(Buffer.concat(data).toString());
    */
    
    //getInfo(message);
    
    if (eventname === "") {
    
      eventname = "DEFAULT_EVENT_NAME";
    }
    
    fetch('https://www.onelayerpancake.com/includes/addevent.inc.php', {
        method: 'POST',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ 
          "id": 78912,
          "eventname": eventname,
          "eventdate": "TBD",
          "maxplayers": 5,
          "player1": "unknown",
          "player2": "unknown",
          "player3": "unknown",
          "player4": "unknown",
          "player5": "unknown"
        
        
        
        })
    })
    .then(response => response.json())
    .then(response => message.reply("Added a new event with date TBD, max players is 5"))
 //   .then(response => console.log(JSON.stringify(response)))
    
    
// JSON.stringify(data)
    /*
    
    const express = require("express");
    const app = express();
    
    app.listen(3000, function(){
      console.log("server is running on port 3000");
    })
    
    */
    
    
    /*
    const parameters = {
      name: "OLP",
      type: "Website"
    }
    
    const post_data = querystring.stringify(parameters);
    
    const options = {
      url: "http://www.onelayerpancake.com",
      port: "80",
      path: "/includes/addevent.inc.php",
      method: "POST"
    }
    
    const request = http.request(options, (response) => {
      if (response) {
        console.log(response);
      }
    });
    
    const request = http.request(options, (response)=>{
      // holds all chunks
      let chunks_of_data = [];
    
      // gather chunk
      response.on('data', (fragments) => {
        chunks_of_data.push(fragments);
      });
    
      // no more data to come
      // combine all chunks
      response.on('end', () => {
        let response_body = Buffer.concat(chunks_of_data);
        
        // response body as string
        console.log(response_body.toString());
      });
    });
    
    request.write(post_data);
    
    
    
    request.end();
    */
    
    
    
    /*
    fetch('https://www.onelayerpancake.com/includes/addevent.inc.php', {
        method: 'POST',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ "eventNAME": "testevent", "eventDATE": "testevent", "maxplayers": "maxplayers", "player1": "testevent","player2": "testevent","player3": "testevent","player4": "testevent","player5": "testevent"  })
    })
    .then(response => response.json())
    .then(response => console.log(JSON.stringify(response)))
    */
    
      }


  if (message.content.indexOf("pancake") != -1) {

    // const ayy = client.emojis.cache.find(emoji => emoji.name === "eyes");
  //message.react(ayy.id);

   message.react('🥞');
 // message.react('🤯');
 // message.react(':pancakes:');
//message.react('\:smile:');
    }



    console.log("msg");

    console.log("msg2" + message.content);
console.log("PREFIX" + prefix);


if (message.content === "test") {
    console.log("testo");
}

    if (!message.content.startsWith(prefix)) return;
    console.log("msg3");

    const commandBody = message.content.slice(prefix.length);
    const args = commandBody.split(' ');
    const command = args.shift().toLowerCase();
    console.log("command" + command);


    if (command === "commands" || command === "help") {
    
            message.reply(`PANCAKEBOT has these commands: /play URL, /stop, !ping, !stats, !trance`);   
          }




    if (command === "giveroles") {
console.log("attempted to give role");
     // var role = message.guild.roles.cache.find(role => role.name === "test");
     // message.member.roles.addRole(role);



     let role = message.member.guild.roles.cache.find(role => role.name === "Survivor");
     if (role) message.guild.members.cache.get(message.author.id).roles.add(role);

     let role2 = message.member.guild.roles.cache.find(role => role.name === "Shai Training");
     if (role2) message.guild.members.cache.get(message.author.id).roles.add(role);
     
     let role3 = message.member.guild.roles.cache.find(role => role.name === "Horseback Tamer Training");
     if (role3) message.guild.members.cache.get(message.author.id).roles.add(role);

     let role4 = message.member.guild.roles.cache.find(role => role.name === "Clip-making");
     if (role4) message.guild.members.cache.get(message.author.id).roles.add(role);




      message.reply(`Updated roles!`);   
    }

    if (command === "listemojis") {
   //   const emojiList = message.guild.emojis.cache.map(emoji => emoji.toString()).join(" ");
   //   message.reply(`emoji list:` + emojiList);
      const emojiList = message.client.emojis.cache.map(emoji => emoji.toString()).join(" ");
      message.reply(`emoji list:` + emojiList);
    }

    if (command === "ping") {
        const timeTaken = Date.now() - message.createdTimestamp;
        console.log("send something");
        message.reply(`Pong! This message had a latency of ${timeTaken}ms.`);                     
    }  
    if (command === "stats") {
      const discordJSVersion = packageJSON.dependencies["discord.js"];
      message.reply(`version:` + discordJSVersion); 
      /*
      const embed = new Discord.MessageEmbed()
            .setColor("RANDOM")
            .setTitle(`Bot stats - ${client.user.tag}`)
            .addField("Discord.js version", discordJSVersion);
        message.channel.send({
            embeds: [embed]
        });            */
  }  

    if (command === "trance") {



      if(!message.member.voice.channel) return message.channel.send("Please connect to a voice channel!"); //If you are not in the voice channel, then return a message
     // message.member.voice.channel.join(); 

     const connection = joinVoiceChannel({
      channelId: message.member.voice.channel.id,
      guildId: message.guild.id,
      adapterCreator: message.guild.voiceAdapterCreator,
      selfDeaf: false
  })

  /*
 const stream = ytdl('twkb6WkR6zE', {
  filter:'audioonly',
  quality: 'highestaudio',
  highWaterMark: 1 << 25
});*/


let stream = ytdl('twkb6WkR6zE', {
  filter : "audioonly",
  opusEncoded : false,
  fmt : "mp3",
  encoderArgs: ['-af', 'bass=g=10,dynaudnorm=f=200'] 
});


 const player = createAudioPlayer();

const resource = createAudioResource(stream, {
  inputType: StreamType.Arbitrary,
});

/*

ssh root@144.202.36.229

pm2 start bot2.js
pm2 start index.js
pm2 stop bot2.js
pm2 stop index.js

*/


/*

GUILDS	GatewayIntentBits.Guilds
GUILD_BANS	GatewayIntentBits.GuildBans
GUILD_EMOJIS_AND_STICKERS	GatewayIntentBits.GuildEmojisAndStickers
GUILD_INTEGRATIONS	GatewayIntentBits.GuildIntegrations
GUILD_INVITES	GatewayIntentBits.GuildInvites
GUILD_MEMBERS	GatewayIntentBits.GuildMembers
GUILD_MESSAGE_REACTIONS	GatewayIntentBits.GuildMessageReactions
GUILD_MESSAGE_TYPING	GatewayIntentBits.GuildMessageTyping
GUILD_MESSAGES	GatewayIntentBits.GuildMessages
GUILD_PRESENCES	GatewayIntentBits.GuildPresences
GUILD_SCHEDULED_EVENTS	GatewayIntentBits.GuildScheduledEvents
GUILD_VOICE_STATES	GatewayIntentBits.GuildVoiceStates
GUILD_WEBHOOKS	GatewayIntentBits.GuildWebhooks
DIRECT_MESSAGES	GatewayIntentBits.DirectMessages
DIRECT_MESSAGE_TYPING	GatewayIntentBits.DirectMessageTyping
DIRECT_MESSAGE_REACTIONS	GatewayIntentBits.DirectMessageReactions
N/A	GatewayIntentBits.MessageContent


*/

// connection?.play(stream, {seek:0, volume:1})
  //      .on('finish', () => msg.member?.voice.channel?.leave());
  //  }
  player.play(resource);
  connection.subscribe(player);
  player.on(AudioPlayerStatus.Idle, () => connection.destroy());

  }
  
});

  /*
  export default async (msg: Message) => {
    if(!msg.member?.voice.channelID){
        msg.channel.send(
            new MessageEmbed()
            .setColor(config.embedColor)
            .setTitle('You Must Be In A Voice Channel To Play Audio')
            .setThumbnail(msg.author.displayAvatarURL())
            .setDescription('Please join a voice channel to play audio')
        )
        return;
    }

    const connection = await msg.member.voice.channel?.join();
    const stream = await ytdl('w2Ov5jzm3j8', {filter:'audioonly'});
    connection?.play(stream, {seek:0, volume:1})
        .on('finish', () => msg.member?.voice.channel?.leave());
    console.log('playing')
        
}

*/









/*



https://discord.com/developers/applications/1041437011283812422/oauth2/url-generator





*/

// node index.js to boot

client.login(config.BOT_TOKEN);

console.log("heyy");


client.on(Events.InteractionCreate, interaction => {
	if (!interaction.isButton()) return;
	//console.log(interaction);




  if (interaction.customId === 'fourth') {

    
    const interactionID =interaction.message.id;


    let foundthing = 0;
  
    for(x=0;x<mID;x++) {
  
      var curID = messagesID[x];
  
      if (curID == interactionID) {
  
console.log("ASSESSING " + curID);
            groupname=messagesNAME[x];
            groupid=curID;
            foundthing= 1;
      }
      
    }

    console.log("FOURTH - REFRESH");

    if (foundthing == 0) {
  
       rapidrequest = 0;
      interaction.reply("Something went wrong  (don't use old posts!)");
        } else {
      
          const eventnamestrimmed =groupname.trim();
          const message = interaction;
              const playernames = message.member.displayName;
       
      
            fetch('https://www.onelayerpancake.com/geteventinfo.php', {
              method: 'POST',
              headers: {
                  'Accept': 'application/json',
                  'Content-Type': 'application/json'
              },
              body: JSON.stringify({ 
                "id": 78912,
                "eventname": eventnamestrimmed
              
              
              })
          })
          .then(response => response.text().then(function (text) {  // 0 3 6 7 8 9
          console.log(text);
            if (text[0] === "3") { console.log(text); /*message.reply("Set max players to 3");*/
          
         
         

           var allstring = text.split("`t");

           
           
           var playerss = "" + allstring[3] + ", "  +allstring[4] +  ", "  +allstring[5] +  ", " + allstring[6] +  ", "  +allstring[7]; 
       
           if (allstring[1] === 3 || allstring[1] === '3') {
            playerss = "" + allstring[3] + ", "  +allstring[4] +  ", "  +allstring[5];
       
           }
       
       
           buildCardForEvent5(message, eventnamestrimmed, allstring[1], allstring[2], playerss);
          
           deleteOriginalCard(message, interaction.message.id);

          // message.reply("Refresh complete");
          
          
          
          } else if (text[0] === "8") { console.log(text); message.reply("Failed to refresh, no such event"); } else if (text[0] === "6") { console.log(text); message.reply("No refresh"); } else if (text[0] === "0") { console.log(text); message.reply("Something didn't go right"); } }
          ));
          
    
    
    
    
    
    
    
              
        }
    


  }


  if (interaction.customId === 'third') {


    const interactionID =interaction.message.id;


    let foundthing = 0;
  
    for(x=0;x<mID;x++) {
  
      var curID = messagesID[x];
  
console.log("ASSESSING " + curID);

      if (curID == interactionID) {
  
            groupname=messagesNAME[x];
            groupid=curID;
            foundthing= 1;
      }
      
    }
  
    if (foundthing == 0) {
  
      rapidrequest = 0;
       
  interaction.reply("Something went wrong  (don't use old posts!)");
    } else {
  
      const eventnamestrimmed =groupname.trim();
      const message = interaction;
          const playernames = message.member.displayName;
   
  
        fetch('https://www.onelayerpancake.com/includes/setmaxplayerthree.inc.php', {
          method: 'POST',
          headers: {
              'Accept': 'application/json',
              'Content-Type': 'application/json'
          },
          body: JSON.stringify({ 
            "id": 78912,
            "eventname": eventnamestrimmed
          
          
          })
      })
      .then(response => response.text().then(function (text) {  // 0 3 6 7 8 9
      console.log(text);
        if (text[0] === "3") { console.log(text); /*message.reply("Set max players to 3");*/
      
        setMaxPlayersFromEventName(eventnamestrimmed, 3);


        var currenteventdate = getDateFromEventID(interactionID);
        var currentmaxplayers = getMaxPlayersFromEventID(interactionID);
      
        buildCardForEvent2(message, eventnamestrimmed, currentmaxplayers, currenteventdate);
      
      
      
      
      
      } else if (text[0] === "8") { console.log(text); message.reply("Failed to Set max players to 3, no such event"); } else if (text[0] === "6") { console.log(text); message.reply("Max players was already 3"); } else if (text[0] === "0") { console.log(text); message.reply("Something didn't go right"); } }
      ));
      







          
    }




  }
  if (interaction.customId === 'secondary') {



    let groupname= "";
    let groupid=-1;
  
    const interactionID =interaction.message.id;
  
    let foundthing = 0;
  
    for(x=0;x<mID;x++) {
  
      var curID = messagesID[x];
  
      if (curID == interactionID) {
  
            groupname=messagesNAME[x];
            groupid=curID;
            foundthing= 1;
      }
      
    }
  
    if (foundthing == 0) {
  
      rapidrequest = 0;
       
  interaction.reply("Something went wrong (don't use old posts!)");
    } else {
  
  
  
    //  interaction.reply("You've been added to the "+groupname+" party");
  
      const eventnamestrimmed =groupname.trim();
  const message = interaction;
      const playernames = message.member.displayName;
      console.log("WHO SENT" + message.member.displayName);
          fetch('https://www.onelayerpancake.com/includes/leaveevent.inc.php', {
              method: 'POST',
              headers: {
                  'Accept': 'application/json',
                  'Content-Type': 'application/json'
              },
              body: JSON.stringify({ 
                "id": 78912,
                "eventname": eventnamestrimmed,
                "playername": playernames
              
              
              })
          })
          .then(response => response.text().then(function (text) {  // 0 3 6 7 8 9
      console.log(text);
      if (text[0] === "0") { console.log(text); message.reply(playernames + " was removed from the event"); } else if (text[0] === "T") { console.log(text); message.reply("Not in party"); } else if (text[0] === "2") { console.log(text); message.reply("Added player as the fifth and final player"); } else if (text[0] === "4") { console.log(text); message.reply("Added player as fourth player"); } else if (text[0] === "1") { console.log(text); message.reply("Added player as third joiner"); } else if (text[0] === "5") { console.log(text); message.reply("Added player as second to join"); } else if (text[0] === "9") { console.log(text); message.reply("Invalid request"); }  else if (text[0] === "3") { console.log(text); message.reply("Something went wrong with the query"); } else if (text[0] === "6") { console.log(text); message.reply("Unable to add, could not insert"); }  else if (text[0] === "7") { console.log(text); message.reply("Unable to add, the event is full"); } else if (text[0] === "8") {  console.log(text); message.reply("Unable to add, no event exists"); } else { console.log(text); message.reply("Unable to add, unknown error"); }
  
      
      
      
            }));
  
            
  
          }
  





  }



  if (interaction.customId === 'primary') {


if (rapidrequest === 1) {

  interaction.reply("Hold on, pls try again in a moment");
 

} else {


rapidrequest = 1;


  let groupname= "";
  let groupid=-1;

  const interactionID =interaction.message.id;

  let foundthing = 0;
console.log("ARRAY LENGTH IS " + mID);
console.log(messagesNAME[0]);
console.log(messagesID[0]);
console.log(messagesMAXPLAYERS[0]);
console.log("interactionID" +interactionID);
  for(x=0;x<mID;x++) {

    var curID = messagesID[x];

    if (curID == interactionID) {

          groupname=messagesNAME[x];
          groupid=curID;
          foundthing= 1;
    }
    
  }

  if (foundthing == 0) {
    console.log("THING1" + interaction.message.id);
     
console.log("THING2" + groupid);
console.log("THING3" +groupname);
         
       rapidrequest = 0;
interaction.reply("Something went wrong  (don't use old posts!)");
  } else {



  //  interaction.reply("You've been added to the "+groupname+" party");

    const eventnamestrimmed =groupname.trim();
const message = interaction;
    const playernames = message.member.displayName;
    console.log("WHO SENT" + message.member.displayName);
        fetch('https://www.onelayerpancake.com/includes/registerforevent.inc.php', {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ 
              "id": 78912,
              "eventname": eventnamestrimmed,
              "playername": playernames
            
            
            })
        })
        .then(response => response.text().then(function (text) {  // 0 3 6 7 8 9
    console.log(text);
    rapidrequest = 0;
    if (text[0] === "0") { console.log(text); message.reply(playernames + " was added to the event"); } else if (text[0] === "T") { console.log(text); message.reply(playernames + " already in the party"); } else if (text[0] === "2") { console.log(text); message.reply("Added " + playernames+ " as the fifth and final player"); } else if (text[0] === "4") { console.log(text); message.reply("Added " + playernames+ " as fourth player"); } else if (text[0] === "1") { console.log(text); message.reply("Added " + playernames+ " as third joiner"); } else if (text[0] === "5") { console.log(text); message.reply("Added " + playernames+ " as second to join"); } else if (text[0] === "9") { console.log(text); message.reply("Invalid request"); }  else if (text[0] === "3") { console.log(text); message.reply("Added " + playernames+ " as first joiner"); } else if (text[0] === "6") { console.log(text); message.reply("Unable to add, could not insert"); }  else if (text[0] === "7") { console.log(text); message.reply("Unable to add, the event is full"); } else if (text[0] === "8") {  console.log(text); message.reply("Unable to add, no event exists"); } else { console.log(text); message.reply("Unable to add, unknown error"); }

    
    
    
          }));

          

        }
      }


  }

//interaction.channel.send("BUTTON PRESSED");
//interaction.editReply("TEST");

//interaction.response.defer();
//interaction.respond();
 //interaction.deferReply({ ephemeral: true });
//wait(4000);
     //interaction.editReply('Pong!');
});
