function Cats({cats}) {

    return (
        <>
        {
            cats.map((c, i) => <div key={i}>{c}</div>)
        }
        </>
    )
}

export default Cats;