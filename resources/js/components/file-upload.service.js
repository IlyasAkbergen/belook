import * as axios from 'axios';

const BASE_URL = 'http://belook.kz';

function upload(formData) {
    const url = `${BASE_URL}/uploadGoods`;
    return axios.post(url, formData)
        // get data
        .then(x => x.data)
        // // add url field
        // .then(x => x.map(img => Object.assign({},
        //     img, { url: `${BASE_URL}/images/${img.id}` })));
}

export { upload }