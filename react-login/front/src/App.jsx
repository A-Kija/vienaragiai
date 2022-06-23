import { useEffect } from 'react';
import { useState } from 'react';
import './App.css';
import Home from './Components/Home';
import Login from './Components/Login';
import axios from "axios";
import { authConfig } from './Functions/auth';

function App() {

  const [user, setUser] = useState(null);
  const [refresh, setRefresh] = useState(true);

  useEffect(() => {
    axios.get('http://localhost/vienaragiai/react-login/back/?url=auth', authConfig())
        .then(res => {
            if (res.data.user) {
              setUser(res.data.user);
            } else {
              setUser(null)
            }
         });
  }, [refresh]);

  return (
    <div className="App">
      <header className="App-header">
        {
          user ? <Home user={user}  setRefresh={setRefresh} /> : <Login setRefresh={setRefresh} />
        }
      </header>
    </div>
  );
}

export default App;
