class App {



    async fetchData(search, searchOption) {

        try {



            const requestOptions = {

                method: 'GET',

                redirect: 'follow'

            };

            

            const response = await fetch(`https://apisearcher.oficinacentral.info/api?search=${encodeURIComponent(search).replace('%20', '+')}&media=${searchOption}`, requestOptions);

            const data = await response.json();

    

            if(!response.ok) {

                throw response.status;

            }

            return data;



        } catch(err) {

            return err;

        }



        



    }

    renderTemplate($template, $fragment, name, url, source) {



        if(url !== '' || url !== undefined) {

            $template.querySelector('a').href = url;

            $template.querySelector('a').textContent = `${name} from ${source}`;

        } else {



            $template.querySelector('li').textContent = `${name} from ${source}`;



        }



        

        let $clone = document.importNode($template, true);

        $fragment.appendChild($clone);



    }

    iTunesSource(name, source) {



        return {

            name: (name.collectionName !== undefined) ? name.collectionName : name.trackName,

            url: (name.trackViewUrl !== undefined) ? name.trackViewUrl : name.collectionViewUrl,

            source: source

        }



    }

    

}