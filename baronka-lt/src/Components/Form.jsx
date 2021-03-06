import { useState } from 'react';

function Form({showForm, setFormData, error}) {

    const [alabama, setAlabama] = useState('');

    const go = () => {
        setFormData({alabama});
    }


    if(!showForm) {
        return null;
    }

    return (
        <>
            <h1>Alamaba Form</h1>

            <fieldset>
                <legend>Enter</legend>
                    <input style={{color: error ? 'red' : null}} type="text" name="alabama" value={alabama} onChange={e => setAlabama(e.target.value)} />
                    <button onClick={go}>GO</button>
            </fieldset>
        </>
    )

}

export default Form;