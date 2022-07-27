import * as bootstrap from 'bootstrap';
import axios from 'axios';
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.addEventListener('load', () => {
    axios.get(mySmallCart)
        .then(res => {
            document.querySelector('.small--cart').innerHTML = res.data.html;
        })
});



if (document.querySelector('.magic--link')) {

    const selector = document.querySelector('[name=color_id]');
    const magicLink = document.querySelector('.magic--link');
    const linkText = magicLink.querySelector('span');

    const doLink = () => {
        magicLink.setAttribute('href', showUrl + '/' + selector.value);
        linkText.innerText = selector.options[selector.selectedIndex].text;
    }

    selector.addEventListener('change', () => {
        doLink();
    });

    window.addEventListener('load', () => {
        doLink();
    });

}

if (document.querySelector('.add--cart')) {

    document.querySelectorAll('.add--cart')
        .forEach(b => {
            b.addEventListener('click', () => {
                const row = b.closest('.row');
                const count = row.querySelector('[name=animals_count]').value;
                const animalId = row.querySelector('[name=animal_id]').value;
                axios.post(addToCartUrl, { count, animalId })
                    .then(res => {

                        axios.get(mySmallCart)
                            .then(res => {
                                document.querySelector('.small--cart').innerHTML = res.data.html;
                            })

                    })

            })
        })

}