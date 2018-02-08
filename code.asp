<%  
    Function TimeStamp()
        Dim strResult
        Dim x
        TimeStamp = now()
        For x = 1 To len(TimeStamp)
            If asc(mid(TimeStamp,x,1)) >=48 And asc(mid(TimeStamp,x,1)) <=57 Then
                strRebuilt = strRebuilt & mid(TimeStamp,x,1)
            End If
        Next
        TimeStamp = strRebuilt
    End Function  

    Sub SystemEmail(stpBody)
        Dim sTextBody
        sTextBody = ""    ' Reset
        sTextBody = sTextBody & "Email from Builders-Steel.com website visitor" & vbcrlf & vbcrlf
        sTextBody = sTextBody & stpBody
        sTextBody = sTextBody & vbcrlf & vbcrlf
        sTextBody = sTextBody & "Submitted: " & now & vbcrlf
        sTextBody = sTextBody & "Remote IP: " & Request.ServerVariables("REMOTE_ADDR") & vbcrlf
        sTextBody = sTextBody & "Remote Host: " & Request.ServerVariables("REMOTE_HOST") & vbcrlf
        '
        Dim fn
        fn = "C:\inetpub\wwwroot\Builders-Steel\" & TimeStamp & ".cmpmx"
        Dim fs,f
        Set fs=Server.CreateObject("Scripting.FileSystemObject")
        Set f=fs.createtextfile(fn,True)
        f.writeline("##COMPANYNAME:Builders-Steel")
        f.writeline("##NOTIFY:info@builders-steel.com")
        f.writeline("##FROM:noreply@builders-steel.com")
        f.writeline("##SMTPSERVER:mail.kelcontech.com")
        f.writeline("##SMTPPORT:26")
        f.writeline("##SMTPUSERNAME:builderssender")
        f.writeline("##SMTPPASSWORD:S3nd1NgTH3M@ilN0w")
        f.writeline("##SUBJECT: Builders-Steel Website Visitor Comments")
        f.writeline(vbcrlf & sTextBody)
        f.close
    End Sub
%>
