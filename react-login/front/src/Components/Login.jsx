import axios from "axios";
import { useEffect } from "react";
import { useState } from "react";
import { authConfig, login } from "../Functions/auth";


function Login() {

    const [loginData, setLoginData] = useState(null);
    const [name, setName] = useState('');
    const [pass, setPass] = useState('');

    const doLogin = () => {
        setLoginData({name, pass});
    }
    

    useEffect(() => {
        if (loginData === null) return;
        axios.post('http://localhost/vienaragiai/react-login/back/?url=login', loginData, authConfig())
        .then(res => {
            if (res.data.token) {
                login(res.data.token);
            }
            console.log(res.data)
        });
    },[loginData])

    return (
        <>
            <div className="nice-input">
            NAME: <input type="text" value={name} onChange={e => setName(e.target.value)}></input>
            </div>
            <div className="nice-input">
            PASS: <input type="password" value={pass} onChange={e => setPass(e.target.value)}></input>
            </div>
            <button className="up" onClick={doLogin}>Login</button>
        </>
    )


}

export default Login;