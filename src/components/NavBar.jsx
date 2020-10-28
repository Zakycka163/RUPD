const NavBar = () => {
    return (
        <nav className="navbar bg-light sticky-top d-none d-lg-flex">
            <ul className="nav nav-pills">
                <li className="nav-item">
                    <a className="btn btn-primary active" href="/">Главная</a>
                </li>
                <li className="nav-item">
                    <a className="btn btn-light" type="button" href="/pages/about.php">О системе</a>
                </li>
            </ul>
            <form className="form-inline">
                <input className="btn btn-success" type="button" value="Войти" />
            </form>
        </nav>
    )
}

export default NavBar;