import { useEffect } from "react";
import { useState } from "react";
import axios from 'axios';
import { authConfig, logout } from "../Functions/auth";

function Home({user, setRefresh}) {

    const [list, setList] = useState([]);

    const doLogOut = () => {
        logout();
        setRefresh(r => !r);
    }

    useEffect(() => {
        axios.get('http://localhost/vienaragiai/react-login/back/?url=home', authConfig())
        .then(res => setList(res.data));
    },[])
    
    return (
        <>
            <h1>Welcome, my Dear {user.full_name}</h1>
            {
                list.map((d, i) => <div key={i}>{d}</div>)
            }
            <button className="up" onClick={doLogOut}>Logout</button>
        </>
    )

}

export default Home;