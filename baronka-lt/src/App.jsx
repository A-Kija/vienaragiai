import './App.css';
import Home from './Components/Home';
import { useEffect, useState } from 'react';
import axios from 'axios';
import Form from './Components/Form';

function App() {

  const [list, setList] = useState([]);

  const [showForm, setShowForm] = useState(false);

  const [formData, setFormData] = useState(null);

  const [youSay, setYouSay] = useState('');

  const [error, setError] = useState(false);

  useEffect(() => {

      axios.get('http://baronka.lt/api/home1')
      .then(res => {
        console.log(res);
        setList(res.data)
      })

  }, []);

  useEffect(() => {
    if (formData === null) return;
    axios.post('http://baronka.lt/api/form', formData)
    .then(res => {
        console.log(res.data);
        if (res.data.err === 1) {
          setError(true);
        } else {
          setYouSay(res.data.youSay);
        }
        
    })

}, [formData]);


  return (
    <>
      
      <Home list={list}></Home>
      <h1>{youSay}</h1>
      <button onClick={() => setShowForm(f => !f)}>Show form</button>
      <Form error={error} showForm={showForm} setFormData={setFormData}></Form>
    </>
  );
}

export default App;
