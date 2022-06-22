import './App.css';
import Home from './Components/Home';
import Login from './Components/Login';
import { login } from './Functions/auth';

function App() {

  // login('lalala-bebras');

  return (
    <div className="App">
      <header className="App-header">
        <Login></Login>
        <Home></Home>
      </header>
    </div>
  );
}

export default App;
