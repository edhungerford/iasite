
</main>
<footer>
    <hr />
    <p><i>IA IA IA</i> thanks you for your continued readership. <a href="/feed.xml"><?php require ROOT_PATH . "/Feed-icon.svg"; ?></a></p>
    <p><a href='https://ko-fi.com/Z8Z31E9W2' target='_blank'><img height='100' style='border:0px;height:70px;' src='https://storage.ko-fi.com/cdn/kofi2.png?v=3' border='0' alt='Buy Me a Coffee at ko-fi.com' /></a></p>
</footer>
</div>
<script>
    document.addEventListener("change", function(event){
        if(event.target.matches("select.blogSwitch")){
            window.location.href = '/blog/?id=' + event.target.value;
        }
    })
</script>
<script>
    document.querySelector("#menuIcon").addEventListener("click", function(event){
        document.querySelector("#mobileMenu").style.display = "flex";
    })
    document.querySelector("#close").addEventListener("click", function(event){
        document.querySelector("#mobileMenu").style.display = "none";
    })
</script>
<script>
    document.addEventListener("change", function(event){
        if(event.target.matches("select.pageSwitch")){
            var path = window.location.pathname.split("/");
            window.location.href = "/" + path[1] + "/" + event.target.selectedIndex;
        }
    })
</script>