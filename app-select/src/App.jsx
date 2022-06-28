import { useEffect } from 'react';
import { useState } from 'react';
import './App.css';

function App() {

  const [select, setSelect] = useState('v');
  const [cb, setCb] = useState({m: false, b:true, z:false, v:true});

  const checkIt = p => {
    // setCb(c => ({...c, [p]: !c[p]}))
    const copyCb = {...cb};
    copyCb[p] = !copyCb[p];
    setCb(copyCb);
    // setCb({...cb, [p]: !cb[p]})
  }

  const doSelect = e => {
    // setSelect(e.target.value);
    // console.log(select);

    setSelect(s => {
      setSelect(e.target.value);
    });

  }

  useEffect(() => {
    console.log(select);
  }, [select]);

  return (
    <div className="App">
      <header className="App-header">
        <h1>Do Select: {select}</h1>

        <select value={select} onChange={doSelect}>
          <option value="m">Meška</option>
          <option value="b">Briedis</option>
          <option value="z">Zebras</option>
          <option value="v">Vilkas, Varna ir Vėplys ir dar voverė</option>
        </select>

        <h2>Do Check:</h2>

        <div>Meška<input type="checkbox" value="m" onChange={() => checkIt('m')} checked={cb.m} /></div>
        <div>Briedis<input type="checkbox" value="b" onChange={() => checkIt('b')} checked={cb.b} /></div>
        <div>Zebras<input type="checkbox" value="z" onChange={() => checkIt('z')} checked={cb.z} /></div>
        <div>Vilkas, Varna ir Vėplys ir dar voverė<input type="checkbox" value="v" onChange={() => checkIt('v')} checked={cb.v} /></div>

      </header>
    </div>
  );
}

export default App;
