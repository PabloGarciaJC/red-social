class configClass {
    constructor() {
        this.url = "";
        this.baseUrl = "";
        this.userLogin = "";
    }

    setPageData() {
        window.url = new URL(window.location.href);        
        window.baseUrl = window.url.origin + '/';       
        window.userLogin = $('#user-data').data('user-id');
    }

    init() {
        this.setPageData();
    }
}

let initConfig = new configClass();
initConfig.init(); 
