window.makeApiRequest = async (url, method, data = {}) => {
    try {
        const response = await fetch(url, {
            method: method,
            headers: getHeaders(),
            body: method !== "GET" ? JSON.stringify(data) : undefined,
        });

        const responseData = await response.json();

        if (!response.ok) {
            throw new Error(responseData.message || "Something went wrong.");
        }

        return responseData; // Return response if successful
    } catch (error) {
        throw error; // Forward the error to be handled by the caller
    }
}

 function getHeaders() {
    return {
        "Content-Type": "application/json",
        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
    };
}
