import axios from "axios";
import { useEffect, useState } from "react";

function Colors({ niceColors, saveUrl }) {


    
    const [colors, setColors] = useState([]);
    const [color, setColor] = useState('#00ff09');

    
    const save = () => {
        if (null !== colors) {
        axios.post(saveUrl, colors)
        .then(res => console.log(res))
        }
    }

    useEffect(() => {
        setColors(niceColors);
    }, []);

    
    useEffect(() => {
        const timerId = setInterval(() => {
            save();
        }, 4000);
       return () => clearInterval(timerId);
    }, [save]);


    const add = () => {
        setColors(c => [...c, color]);
    }



    return (
        <>
            <div className="my-bin">
                {
                    colors?.map((c, i) => <div key={i} className="my-colors-square" style={{
                        backgroundColor: c,
                        opacity: 0.7
                    }}>{c}</div>)
                }
            </div>
            <div className="my-bin">
            <input type="color" value={color} onChange={e => setColor(e.target.value)}></input>
            </div>
            <div className="my-bin">
            <button type="button" onClick={add} className="inline-block px-6 py-2 border-2 border-blue-600 text-blue-600 font-medium text-xs leading-tight uppercase rounded hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0 transition duration-150 ease-in-out">Add []</button>
            </div>
            <div className="my-bin">
            <button type="button" onClick={save} className="inline-block px-6 py-2 border-2 border-blue-600 text-blue-600 font-medium text-xs leading-tight uppercase rounded hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0 transition duration-150 ease-in-out">Save</button>
            </div>
        </>
       



        
    )
}

export default Colors;