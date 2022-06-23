export const login = key => {
    sessionStorage.setItem('session', key);
}
export const logout = () => {
    sessionStorage.removeItem('session');
}

export const authConfig = () => {
    return {
        headers: { Authorization: `${sessionStorage.getItem('session') ?? ''}` }
    }
}