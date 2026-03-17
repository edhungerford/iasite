
</main>
<footer>
    <hr />
    <p><i>IA IA IA</i> thanks you for your continued readership. <a href="/feed.xml"><?php require ROOT_PATH . "/Feed-icon.svg"; ?></a></p>
    <p><a href="https://patreon.com/IAIAIAWORLD?utm_medium=unknown&utm_source=join_link&utm_campaign=creatorshare_creator&utm_content=copyLink">Support me on Patreon.</a></p>
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