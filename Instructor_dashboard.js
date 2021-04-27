import { useHistory } from "react-router-dom";
import "./Instructor_dashboard.css";
import { useEffect } from "react";
import Cookies from "js-cookie";
import axios from "axios";
import { useState } from "react";
import Modal from "react-modal";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faBeer } from "@fortawesome/free-solid-svg-icons";

export default function Dashboard() {
  const history = useHistory();
  const [ModalIsOpen, setModalIsOpen] = useState(false);
  let j = 0;

  const [rows, setRows] = useState(null);
  useEffect(() => {
    Cookies.get("SESSION-KEY") === undefined
      ? history.push("/login")
      : history.push("/instructor");
    axios
      .get("http://0.0.0.0:8086/instructor/game", {
        headers: {
          "SESSION-KEY": Cookies.get("SESSION-KEY"),
        },
      })
      .then((response) => {
        setRows(response.data);
      })
      .catch((error) => {
        console.log(error.response);
      });
  }, [setRows]);
  console.log(rows);

  const [state, setState] = useState({
    session_length:"",
    retailer_present: false,
    wholesaler_present: false,
    holding_cost: "",
    backlog_cost:"",
    active: true,
    starting_inventory:"",
    info_delay:"",
    info_sharing:false,
})

  const handleChange = (e) => {
    const { name, value } = e.target
    if(name === "info_sharing" || name === "retailer_present" || name === "wholesaler_present")
    {
        setState(prevState => ({
            ...prevState,
            [name]: e.target.checked
        }))
    }
    else{
        setState(prevState => ({
            ...prevState,
            [name]: value
        }))
    }
}

  const sendDetailsToServer = () => {
        axios.post('http://0.0.0.0:8086/instructor/game', 
        {
            "session_length": parseInt(state.session_length),
            "retailer_present": state.retailer_present,
            "wholesaler_present": state.wholesaler_present,
            "holding_cost": parseInt(state.holding_cost),
            "backlog_cost": parseInt(state.backlog_cost),
            "active": true,
            "starting_inventory": parseInt(state.starting_inventory),
            "info_delay":parseInt(state.info_delay),
            "info_sharing":state.info_sharing,
        },
        {
            headers: {
                "SESSION-KEY": Cookies.get('SESSION-KEY')
            }
        })
        .then(response => {
            console.log(response.data)
            alert("Success, game with id" + response.data.game_id + " is created")
            history.push("/instructor");
        })
        .catch(error => {
            console.log(error.response)
            setState(prevState=>({
                ...prevState,
                error_message: "this is an error message"
            }))
        });
    }
function fun1(){
    setModalIsOpen(false)
}
function fun2(){
    sendDetailsToServer()
}

function callBoth(){
    fun1()
    fun2()
}
  const renderRow = () => {
    if (rows !== null) {
      return rows.map((item) => {
        j++;
        return (
          <tr key={item.game_id}>
            <td>{j}</td>
            <td>{item.session_length}</td>
            <td>{item.retailer_present === 1 ? "Yes" : "No"}</td>
            <td>{item.wholesaler_present === 1 ? "Yes" : "No"}</td>
            <td>{item.holding_cost}</td>
            <td>{item.backlog_cost}</td>
            <td>{item.active === 1 ? "Yes" : "No"}</td>
            <td>{item.info_delay}</td>
            <td>{item.info_sharing === 1 ? "Yes" : "No"}</td>
            <td>
              <button
                type="btn btn-primary"
                onClick={() => setModalIsOpen(true)}
              >
                Edit
              </button>
            </td>
            <Modal
              isOpen={ModalIsOpen}
              shouldCloseOnOverlayClick={false}
              onRequestClose={() => setModalIsOpen(false)}
              style={{
                overlay: {
                  backgroundColor: 'white',
                  height: 600,
                  width: 600,
                  left: '50%',
                },
                content: {
                  color: 'blue',
                }
              }}
            >
              <p>
                <div className="form">
                  <div>
                    <p>
                      <label className="label">
                        Session Length:
                        <input
                          type="number"
                          name="session_length"
                          value={state.session_length}
                          onChange={handleChange}
                          required
                        />
                      </label>
                    </p>

                    <fieldset>
                      <label className="label">Include:</label>
                      <p>
                        <label className="label">
                          {" "}
                          <input
                            type="checkbox"
                            name="retailer_present"
                            checked={state.retailer_present === true}
                            onChange={handleChange}
                          />{" "}
                          Retail{" "}
                        </label>
                      </p>
                      <p>
                        <label className="label">
                          {" "}
                          <input
                            type="checkbox"
                            name="wholesaler_present"
                            checked={state.wholesaler_present === true}
                            onChange={handleChange}
                          />{" "}
                          Wholesaler
                        </label>
                      </p>
                    </fieldset>

                    <p>
                      <label className="label">
                        Holding cost:
                        <input
                          type="number"
                          name="holding_cost"
                          value={state.holding_cost}
                          onChange={handleChange}
                          required
                        />
                      </label>
                    </p>

                    <p>
                      <label className="label">
                        Backlog cost:
                        <input
                          type="number"
                          name="backlog_cost"
                          value={state.backlog_cost}
                          onChange={handleChange}
                          required
                        />
                      </label>
                    </p>

                    <p>
                      <label className="label">
                        Starting Inventory:
                        <input
                          type="number"
                          name="starting_inventory"
                          value={state.starting_inventory}
                          onChange={handleChange}
                          required
                        />
                      </label>
                    </p>

                    <p>
                      <label className="label">
                        Information delay:
                        <input
                          type="number"
                          name="info_delay"
                          value={state.info_delay}
                          onChange={handleChange}
                          required
                        />
                      </label>
                    </p>

                    <p>
                      <label className="label">
                        {" "}
                        <input
                          type="checkbox"
                          name="info_sharing"
                          checked={state.info_sharing === true}
                          onChange={handleChange}
                        />{" "}
                        Information Sharing{" "}
                      </label>
                    </p>
                  </div>
                </div>
              </p>
              <div>
                <button onClick={callBoth}>Update</button>
                <button style={{margin:40 }} onClick={() => setModalIsOpen(false)} >Cancel</button>
              </div>
            </Modal> 
            <td><button type="btn btn-primary">Add players</button></td>
          </tr>
        );
      });
    }
  };

  const addGame = () => {
    history.push("/create-game");
  };

  const logout = () => {
    Cookies.remove("SESSION-KEY");
    history.push("/login");
  };

  return (
    <div className="body">
      <nav className="navbar navbar-expand-lg">
        <div className="container">
          <div id="brand">
            <FontAwesomeIcon icon={faBeer} />
            <a class="navbar-brand ml-2" href="/">
              Your games
            </a>
          </div>
          <div className="navbar-nav">
            <a className="nav-link active" href="#">
              Account Settings
            </a>
            <a className="nav-link active" onClick={logout}>
              Logout
            </a>
          </div>
        </div>
      </nav>
      <div>
        <div className="container">
          <div className="buttons">
            <button type="btn btn-primary btn-lg" onClick={addGame}>
              Create Game
            </button>
          </div>
          <table className="table table-striped table-bordered">
            <thead>
              <tr>
                <th scope="col">Games</th>
                <th scope="col">Session Length</th>
                <th scope="col">Retailer</th>
                <th scope="col">Wholesaler</th>
                <th scope="col">Holding Cost</th>
                <th scope="col">Backlog Cost</th>
                <th scope="col">Active Game</th>
                <th scope="col">Info Delay</th>
                <th scope="col">Info Sharing</th>
                <th scope="col">Edit Game</th>
                <th scope="col">Add Players to Game</th>
              </tr>
            </thead>
            <tbody>{renderRow()}</tbody>
          </table>
        </div>
      </div>
    </div>
  );
}
